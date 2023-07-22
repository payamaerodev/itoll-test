# martin-deliver

## login

از این سرویس به منظور احراز هویت کاربر استفاده می‌شود. دوکاربر پیش فرض با نقش‌های پیک و مجموعه در پروژه از پیش اضافه شده
اند! با این ایمیل و نام کاربری می‌توان برای هر نقش جداگانه لاگین کرد.

### درخواست HTTP

`PUT /set/cancel-request`

### داده درخواستی

| فیلد                | توضیحات                      |
|---------------------|------------------------------|
| service_request_id  | شناسه درخواست سرویس - اجباری |
| longitude           | طول موقعیت -اجباری           |
| latitude            | عرض موقعیت -اجباری           |

### کاربر های پیش فرض

| فیلد                 | توضیحات                   |
|----------------------|---------------------------|
| payam,p@gmail.com    | نام کاربری -ایمیل(مجموعه) |
| pooria,poo@gmail.com | نام کاربری -ایمیل (پیک)   |

خروجی به صورت پاسخ http response code 200 می‌باشد.


> شیوه ارسال درخواست:

```shell
curl --location 'http://127.0.0.1:8001/api/login' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 3|h6bOUwJfjk1aMBQIEH06gun84kdE8e9h8HsRIPPb' \
--data-raw '{
    "email":"poo@gmail.com",
    "name":"pooria"
}'
```

> خروجی :

```json
{
    "accessToken": {
        "name": "courier",
        "abilities": [
            "*"
        ],
        "expires_at": null,
        "tokenable_id": 2,
        "tokenable_type": "App\\Models\\User",
        "updated_at": "2023-07-22T13:50:52.000000Z",
        "created_at": "2023-07-22T13:50:52.000000Z",
        "id": 6
    },
    "plainTextToken": "6|fbJzOb5MukwgNJavOwNLslTa3rMnfVIMcydiCUFy"
}
```

## cancel-request


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

## add-request


از این سرویس به منظور ایجاد یک سفارش توسط مجموعه استفاده می‌شود!

### درخواست HTTP

`PUT /set/add-request`

### داده درخواستی

| فیلد                    | توضیحات                          |
|-------------------------|----------------------------------|
| destination_longitude   |   طول جغرافیایی مقصد - اجباری    |
| destination_latitude    | عرض جغرافیایی مقصد - اجباری      |
| sender_name             | نام ارسال کننده - اجباری         |
| receiver_name           | نام دریافت کننده - اجباری        |
| receiver_number         | شماره تلفن دریافت کننده - اجباری |
| sender_number           | شماره تلفن ارسال کننده - اجباری  |
| source_longitude        | طول جغرافیایی مبدا - اجباری      |
| source_address          | آدرس مبدا - اجباری               |
| destination_address     | آدرس مقصد - اجباری               |
| webhook_url             | آدرس وب هوک - اجباری             |
| source_latitude         | عرض جغرافیایی مبدا - اجباری      |

> شیوه ارسال درخواست:

```shell
curl --location 'http://127.0.0.1:8001/api/set/add-request' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 3|h6bOUwJfjk1aMBQIEH06gun84kdE8e9h8HsRIPPb' \
--data '{
    "destination_longitude": 20,
    "destination_latitude": 22,
    "sender_name": "payam",
    "receiver_name": "peyman",
    "receiver_number": "09125656958",
    "sender_number": "09368585749",
    "source_longitude": 56,
    "source_address": "st 43 no 22",
    "destination_address": "st 43 no 11",
    "webhook_url": "www.payam-website.org",
    "source_latitude": 52
}'
```

> خروجی :

```json
{
    "data": "22e9183e-64de-493e-b763-aff967c221b4"
}
```

> اگر با خطا مواجه شود :

```json
{
    "message": "'message' => 'service request failed!'"
}
```

## get-request


از این سرویس به منظور گرفتن لیست درخواست هایی که پیک می‌تواند قبول کند!

### درخواست HTTP

`PUT /courier/get-requests`

### داده درخواستی

> شیوه ارسال درخواست:

```shell
curl --location 'http://127.0.0.1:8001/api/courier/get-requests' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 13|a0QrNwc7X0GPAPm7zehZh1ZHtOOwzgwNPdfAEmjf' \
--data ''
```

> خروجی :

```json
{
    "data": [
        {
            "id": 486297840,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:19:37.000000Z",
            "updated_at": "2023-07-22T08:19:37.000000Z",
            "uuid": null
        },
        {
            "id": 486297841,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:23:06.000000Z",
            "updated_at": "2023-07-22T08:23:06.000000Z",
            "uuid": null
        },
        {
            "id": 486297842,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:23:57.000000Z",
            "updated_at": "2023-07-22T08:23:57.000000Z",
            "uuid": null
        },
        {
            "id": 486297843,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:24:10.000000Z",
            "updated_at": "2023-07-22T08:24:10.000000Z",
            "uuid": null
        },
        {
            "id": 486297844,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:24:19.000000Z",
            "updated_at": "2023-07-22T08:24:19.000000Z",
            "uuid": null
        },
        {
            "id": 486297845,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:24:38.000000Z",
            "updated_at": "2023-07-22T08:24:38.000000Z",
            "uuid": null
        },
        {
            "id": 486297846,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:25:24.000000Z",
            "updated_at": "2023-07-22T08:25:24.000000Z",
            "uuid": null
        },
        {
            "id": 486297847,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:25:49.000000Z",
            "updated_at": "2023-07-22T08:25:49.000000Z",
            "uuid": null
        },
        {
            "id": 486297848,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:26:18.000000Z",
            "updated_at": "2023-07-22T08:26:18.000000Z",
            "uuid": "d439be07-6eeb-48d6-bce4-d16eedba21a2"
        },
        {
            "id": 486297849,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:26:54.000000Z",
            "updated_at": "2023-07-22T08:26:54.000000Z",
            "uuid": "39bce2cd-8af5-4123-8fcb-470beff9fe67"
        },
        {
            "id": 486297850,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T08:27:11.000000Z",
            "updated_at": "2023-07-22T08:27:11.000000Z",
            "uuid": "b30a57ec-36f3-45e6-853f-2a7d91d7cbcf"
        },
        {
            "id": 486297851,
            "status": "CREATED",
            "user_id": 1,
            "destination_longitude": 20,
            "destination_latitude": 22,
            "sender_name": "payam",
            "receiver_name": "peyman",
            "receiver_number": "09125656958",
            "sender_number": "09368585749",
            "source_longitude": 56,
            "source_latitude": 52,
            "source_address": "st 43 no 22",
            "destination_address": "st 43 no 11",
            "webhook_url": "www.payam-website.org",
            "created_at": "2023-07-22T14:11:31.000000Z",
            "updated_at": "2023-07-22T14:11:31.000000Z",
            "uuid": "22e9183e-64de-493e-b763-aff967c221b4"
        }
    ]
}

```
