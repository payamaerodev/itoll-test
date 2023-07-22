courier ====>>>>>      payam,p@gmail.com
setClient ====>>>>>      pooria,poo@gmail.com
#martin-deliver

از این سرویس به منظور احراز هویت کاربر استفاده می‌شود. دوکاربر پیش فرض با نقش‌های پیک و مجموعه در پروژه از پیش اضافه شده اند! با این ایمیل و نام کاربری می‌توان برای هر نقش جداگانه لاگین کرد. 
### درخواست HTTP

`PUT /set/cancel-request`

### داده درخواستی

| فیلد                | توضیحات                      |
|---------------------|------------------------------|
| service_request_id  | شناسه درخواست سرویس - اجباری |
| longitude           | طول موقعیت -اجباری           |
| latitude            | عرض موقعیت -اجباری           |

خروجی به صورت پاسخ http response code 200 می‌باشد.


> شیوه ارسال درخواست:

```shell
curl --location --request PUT 'http://127.0.0.1:8001/api/courier/accept-request' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 3|h6bOUwJfjk1aMBQIEH06gun84kdE8e9h8HsRIPPb' \
--data '{
    "service_request_id":51084643,
    "longitude":120,
    "latitude":15
}'
```

> خروجی :

```json
{
    "message": "request accepted!"
}
```



از این سرویس به منظور کنسل کردن سفارش توسط مجموعه استفاده می‌شود!

### درخواست HTTP

`PUT /set/cancel-request`

### داده درخواستی

| فیلد                | توضیحات                      |
|---------------------|------------------------------|
| service_request_id  | شناسه درخواست سرویس - اجباری |
| longitude           | طول موقعیت -اجباری           |
| latitude            | عرض موقعیت -اجباری           |

خروجی به صورت پاسخ http response code 200 می‌باشد.


> شیوه ارسال درخواست:

```shell
curl --location --request PUT 'http://127.0.0.1:8001/api/courier/accept-request' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 3|h6bOUwJfjk1aMBQIEH06gun84kdE8e9h8HsRIPPb' \
--data '{
    "service_request_id":51084643,
    "longitude":120,
    "latitude":15
}'
```

> خروجی :

```json
{
    "message": "request accepted!"
}
```
