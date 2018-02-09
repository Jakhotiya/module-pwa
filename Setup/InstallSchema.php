<?php

namespace Magecrafts\WebApp\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        /**
         * Create table 'pwa_user'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('pwa_users')
        )->addColumn(
            'user_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'User ID'
        )->addColumn(
            'customer_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Customer ID'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Email of the subscribed user'
        )->addColumn(
            'endpoint',
            Table::TYPE_TEXT,
            512,
            [],
            'Endpoint url for push'
        )->addColumn(
            'user_agent',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Browser or device for push'
        )->addColumn(
            'is_subscribed',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is user subscribed'
        )->setComment(
            'Push notification user table'
        );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'pwa_notifications'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('pwa_notifications')
        )->addColumn(
            'notification_id',
            Table::TYPE_INTEGER,
            null,
            ['identity'=>true,'nullable' => false, 'primary' => true],
            'Notification ID'
        )->addColumn(
            'type',
            Table::TYPE_TEXT,
            120,
            ['nullable' => false],
            'Notification type'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Notification title'
        )->addColumn(
            'payload',
            Table::TYPE_TEXT,
            512,
            ['nullable' => false],
            'json encoded payload'
        )->addColumn(
            'created_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' =>Table::TIMESTAMP_INIT],
            'create time'
        );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'pwa_user_notifications'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('pwa_user_notifications')
        )->addColumn(
            'record_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'primary' => true,'identity' => true],
            'Record ID'
        )->addColumn(
            'notification_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'Notification ID foreign key'
        )->addColumn(
            'user_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'user ID foreign key'
        )->addColumn(
            'is_sent',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '0'],
            'sent status'
        )->addColumn(
            'is_read',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '0'],
            'sent status'
        )->addForeignKey($installer->getFkName('pwa_user_notifications','user_id','pwa_users','user_id'),
            'user_id','pwa_users','user_id',Table::ACTION_CASCADE)
            ->addForeignKey($installer->getFkName('pwa_user_notifications','user_id','pwa_notifications','notification_id'),
                'notification_id','pwa_notifications','notification_id',Table::ACTION_CASCADE)
            ->setComment(
                'user notification data'
            );
        $installer->getConnection()->createTable($table);

    }
}
