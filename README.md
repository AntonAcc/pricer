## Assignment specifications:

https://github.com/AntonAcc/pricer/blob/master/specifications.md

## Used patterns and principles:

Simple Factory:
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessorFactory.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/TaxService/TaxFactory.php

Factory Method:
- https://github.com/AntonAcc/pricer/blob/master/src/Controller/BaseController.php#L31

Adapter:
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessor/Paypal.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessor/Stripe.php

Strategy:
- https://github.com/AntonAcc/pricer/blob/master/src/Entity/Coupon.php#L32

Template method:
- https://github.com/AntonAcc/pricer/blob/master/src/Controller/BaseController.php#L45

SOLID - Open-Closed Principle:
- https://github.com/AntonAcc/pricer/blob/master/src/Repository/CouponRepositoryInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Repository/ProductRepositoryInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessorInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/TaxService/TaxInterface.php

## Testing:

### Phpunit

```
bin/phpunit
```

### App

```
symfony server:start &
```

Change 34627 to your port

Examples (correct):

```
curl -X POST 127.0.0.1:34627/price/get -d '{"product": "1","taxNumber": "DE123456789"}'
curl -X POST 127.0.0.1:34627/price/get -d '{"product": "1","taxNumber": "DE123456789","couponCode": "D15"}'
curl -X POST 127.0.0.1:34627/payment/process -d '{"product": "1","taxNumber": "DE123456789","couponCode": "D15","paymentProcessor":"paypal"}'
```

Examples (errors):

```
curl -X POST 127.0.0.1:34627/price/get -d '{"product": 1,"taxNumber": "DE123456789"}'
curl -X POST 127.0.0.1:34627/price/get -d '{"product": 1,"taxNumber": "ZZ123456789"}'
curl -X POST 127.0.0.1:34627/payment/process -d '{"product": 1,"taxNumber": "ZZ123456789","couponCode": "D15","paymentProcessor":"paypal"}'
```
