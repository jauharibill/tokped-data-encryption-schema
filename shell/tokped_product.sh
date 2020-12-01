curl -X POST \
    'https://fs.tokopedia.net/v2/products/fs/13389/create?shop_id=8212471' \
    -H 'Authorization: Bearer c:ojPG1m5JSxSLXc7l1pT6oQ' \
    -H 'Content-Type: application/json' \
    -d '{
   "products":[
      {
         "name":"Product Testing V2 1.10",
         "condition":"NEW",
         "description":"Product Testing Descr V2",
         "sku":"TST21",
         "price":10000,
         "status":"LIMITED",
         "stock":900,
         "min_order":1,
         "category_id":1817,
         "price_currency":"IDR",
         "weight":200,
         "weight_unit":"GR",
         "is_free_return":false,
         "is_must_insurance":false,
         "etalase":{
            "id":24101901
         },
         "pictures":[
            {
               "file_path":"https://ecs7.tokopedia.net/img/cache/700/product-1/2017/9/27/5510391/5510391_9968635e-a6f4-446a-84d0-ff3a98a5d4a2.jpg"
            }
         ],
         "wholesale":[
            {
               "min_qty":2,
               "price":9500
            },
            {
               "min_qty":3,
               "price":9000
            }
         ],
         "preorder":{
            "is_active":true,
            "duration":5,
            "time_unit":"DAY"
         },
         "videos": [
            {
                "source": "youtube",
                "url": "3T9DAOQIUDo"
            }
        ]
      }
   ]
}'