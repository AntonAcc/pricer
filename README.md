# Test Assignment - symfony REST app 

## Assignment specifications:

https://github.com/AntonAcc/pricer/blob/master/specifications.md

## Used patterns and principles:

**Simple Factory:**
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessorFactory.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/TaxService/TaxFactory.php

**Factory Method:**
- https://github.com/AntonAcc/pricer/blob/master/src/Controller/BaseController.php#L31

**Adapter:**
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessor/Paypal.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessor/Stripe.php

**Strategy:**
- https://github.com/AntonAcc/pricer/blob/master/src/Entity/Coupon.php#L32

**Template method:**
- https://github.com/AntonAcc/pricer/blob/master/src/Controller/BaseController.php#L45

**SOLID - Open-Closed Principle:**
- https://github.com/AntonAcc/pricer/blob/master/src/Repository/CouponRepositoryInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Repository/ProductRepositoryInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/PaymentService/PaymentProcessorInterface.php
- https://github.com/AntonAcc/pricer/blob/master/src/Service/TaxService/TaxInterface.php

**Value Object:**
- https://github.com/AntonAcc/pricer/blob/master/src/ValueObject/Price.php

## Testing:

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull --wait -d` to start the project

### Phpunit

```
docker compose exec -T php bin/phpunit 
```

### App

Examples (correct):

```
curl -X POST localhost:8080/price/get -d '{"product":"1","taxNumber":"DE123456789"}' -w "\n%{http_code}\n"
curl -X POST localhost:8080/price/get -d '{"product":"1","taxNumber":"DE123456789","couponCode":"D15"}' -w "\n%{http_code}\n"
curl -X POST localhost:8080/payment/process -d '{"product":"1","taxNumber":"DE123456789","couponCode":"D15","paymentProcessor":"paypal"}' -w "\n%{http_code}\n"
```

Examples (errors):

```
curl -X POST localhost:8080/price/get -d '{"product":1,"taxNumber":"DE123456789"}' -w "\n%{http_code}\n"
curl -X POST localhost:8080/price/get -d '{"product":1,"taxNumber":"ZZ123456789"}' -w "\n%{http_code}\n"
curl -X POST localhost:8080/payment/process -d '{"product":1,"taxNumber":"ZZ123456789","couponCode":"D15","paymentProcessor":"paypal"}' -w "\n%{http_code}\n"
```
