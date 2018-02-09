<?php
namespace Magecrafts\WebApp\Model\ResourceModel;

class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('pwa_notifications','notification_id');
    }

    public function _afterSave(\Magento\Framework\Model\AbstractModel $object){
        $id = $object->getNotificationId();
        $connection = $this->getConnection();
        //fetch all users
        $columns = [
            new \Zend_Db_Expr("NULL as record_id"),
            new \Zend_Db_Expr("{$id} as notification_id"),
            new \Zend_Db_Expr('user_id')
        ];
        $select = $connection->select()->from($this->getTable('pwa_users'),$columns);
        $table = $this->getTable('pwa_user_notifications');
        $query = $connection->insertFromSelect($select,$table,['record_id','notification_id','user_id']);
        $connection->query($query);
        return $this;
    }


    protected function _getLoadSelect($field, $value, $object)
    {

        $select = $this->getConnection()->select()
            ->from(['un' => $this->getTable('pwa_user_notifications')],['notification_id','user_id'])
            ->joinInner(['n'=>$this->getTable('pwa_notifications')],'un.notification_id=n.notification_id',['title','payload'])
            ->joinInner(['u'=>$this->getTable('pwa_users')],'un.user_id=u.user_id',['endpoint'])
            ->where('un.notification_id=?', $object->getNotificationId())
            ->where('un.user_id=?', $object->getUserId());
        return $select;
    }
}
