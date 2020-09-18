## wellvitation

wellvitation api , build with laravel lumen.
<br/>
before install aplication in your local device , you shuld install php v.7+ , composer and git. open your commend line and follow the steps below .

```
$ git clone https://github.com/adehikmatfr/wellvitation.git
$ cd wellvitation
$ composer install
$ php -S localhost:8000 -t public
```

## Required plugins and framework

-   🛠 [laravel lumen](https://lumen.laravel.com/)
-   🚦 [dingo/api](https://packagist.org/packages/dingo/api)
-   💼 [iluminate/mail](https://packagist.org/packages/illuminate/mail)
-   🤖 [simple-crcode](https://packagist.org/packages/simplesoftwareio/simple-qrcode)

## features available

-   whatsApp boot
-   payment get ways
-   create online weddings
-   invitation room wedding
-   create a wedding website
-   and more

## API documentation

### note : untuk saat ini saya belum menambahkan authentication token untuk mengisi data id_user untuk sementara di isi langsung di sisi frontend.

===============================================================

## 1. Authentication

```
http:localhost:8000/api/login
```

required body :

-   email
-   password

```
http:localhost:8000/api/register
```

required body :

-   name
-   email
-   password
-   role_id
-   phone
    <br/>

## 2. get users

```
http:localhost:8000/api/user
```

## 3. Roles

```
http:localhost:8000/api/roles
http:localhost:8000/api/roles/{id}
```

method : GET , POST , PATCH , DELETE <br/>
required body :

-   role_name

## 4. Products

```
http:localhost:8000/api/products
http:localhost:8000/api/products/{id}
```

method : GET , POST , PATCH , DELETE <br/>
required body :

-   name_products
-   price
-   detail
-   domain
-   fitur

## 5. Vouchers

```
http:localhost:8000/api/vouchers
http:localhost:8000/api/vouchers/{id}
```

method : GET , POST , PATCH , DELETE <br/>
required body :

-   name_voucher
-   code_voucher
-   discount
-   mix_discount
-   mix_usage

## 6. Description

```
http:localhost:8000/api/descriptions
http:localhost:8000/api/descriptions/{id}
```

method : GET , POST , PATCH , DELETE <br/>
required body :

-   web_name
-   event_name
-   event_desc
-   akad_place
-   akad_address
-   akad_date
-   marriage_place
-   marriage_address
-   marriage_date
-   description
-   message
-   youtube_link
-   asset_link

## 7. Brides

```
http:localhost:8000/api/brides
http:localhost:8000/api/brides/{id}
```

method : GET , POST , PATCH , DELETE <br/>
required body :

-   bridegroom_name
-   bridegroom_religion
-   bridegroom_guardian
-   bridegroom_bio
-   bridegroom_social
-   bride_name
-   bride_religion
-   bride_guardian
-   bride_bio
-   bride_social

## Join with me:

[<img align="left" alt="youtube | YouTube" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/youtube.svg" />][youtube]
[<img align="left" alt="linkedin | LinkedIn" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/linkedin.svg" />][linkedin]
[<img align="left" alt="instagram | Instagram" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/instagram.svg" />][instagram]
[<img align="left" alt="facebook | Instagram" width="22px" src="https://cdn.jsdelivr.net/npm/simple-icons@v3/icons/facebook.svg" />][facebook]

[linkedin]: https://www.linkedin.com/in/adehikmat
[youtube]: https://www.youtube.com/channel/UCpZ-2cuPYGKO-LSR2YHTrAg/
[instagram]: https://www.instagram.com/adehikmat_fr/
[facebook]: https://www.facebook.com/adehikmat.fanzipauzan
[jsonfile]: https://github.com/adehikmatfr/worksheet-template/blob/master/src/config/config.json
