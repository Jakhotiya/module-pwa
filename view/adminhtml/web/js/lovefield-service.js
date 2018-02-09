define(['underscore','Magecrafts_WebApp/js/lovefield'],function(_){

    var isProductTableReady = false;

    var schemaBuilder = lf.schema.create('magento', 1);

    var dataTypes = {
        'string':lf.Type.STRING,
        'number':lf.Type.INTEGER
    };

    function createProductTable(data){
        if(isProductTableReady){
            return true;
        }

        var table = schemaBuilder.createTable('product');

        for(key in data[0]){
            if(_.isArray(data[key]) || typeof data[key] ==='object'){
                continue;
            }
            table.addColumn(key,dataTypes[typeof data[key]]);
        }
        table.addPrimaryKey(['entity_id']);
        var db;
        schemaBuilder.connect().then(function(d){
            db = d;
            var product = db.getSchema().table('product');
            var rows = data.map(item=>product.createRow(item));
            return db.insert().into(product).values(rows).exec();
        }).
        then(function(){
            var product = db.getSchema().table('product');
            return db.select().from(product).exec();
        }).then(res=>console.log(res));

    }

    function connect(){
        return schemaBuilder.connect().then(function(db){
            if(!isProductTableReady)
                isProductTableReady=true;
            return db;
        });
    }

     function getProducts(db){
            var product = db.getSchema().table('product');
            return db.select().from(product).exec();
     }

     return {createProductTable:createProductTable,connect:connect,getProducts:getProducts}

    // var schemaBuilder = lf.schema.create('todo', 1);
    //
    // schemaBuilder.createTable('Item').
    // addColumn('id', lf.Type.INTEGER).
    // addColumn('description', lf.Type.STRING).
    // addColumn('deadline', lf.Type.DATE_TIME).
    // addColumn('done', lf.Type.BOOLEAN).
    // addPrimaryKey(['id']).
    // addIndex('idxDeadline', ['deadline'], false, lf.Order.DESC);
    //
    // var todoDb;
    // var item;
    // schemaBuilder.connect().then(function(db) {
    //     todoDb = db;
    //     item = db.getSchema().table('Item');
    //     var row = item.createRow({
    //         'id': 1,
    //         'description': 'Get a cup of coffee',
    //         'deadline': new Date(),
    //         'done': false
    //     });
    //
    //     return db.insertOrReplace().into(item).values([row]).exec();
    // }).then(function() {
    //     return todoDb.select().from(item).where(item.done.eq(false)).exec();
    // }).then(function(results) {
    //     results.forEach(function(row) {
    //         console.log(row['description'], 'before', row['deadline']);
    //     });
    // });

});