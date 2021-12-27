<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
    /**
     * App\Models\Address
     *
     * @property int $order_id
     * @property int $country_id
     * @property string $city
     * @property string $street
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Country $country
     * @property-read \App\Models\Order $order
     * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Address query()
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountryId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereOrderId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereStreet($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
     */
    class Address extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Basket
     *
     * @property int $id
     * @property int $user_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
     * @property-read int|null $products_count
     * @method static \Illuminate\Database\Eloquent\Builder|Basket newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Basket newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Basket query()
     * @method static \Illuminate\Database\Eloquent\Builder|Basket whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Basket whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Basket whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Basket whereUserId($value)
     */
    class Basket extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Country
     *
     * @property int $id
     * @property string $code
     * @property string $name
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Country query()
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
     */
    class Country extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Order
     *
     * @property int $id
     * @property string $first_name
     * @property string $last_name
     * @property int $user_id
     * @property int $payment_method_id
     * @property int $fast_delivery
     * @property string $order_date
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Address|null $address
     * @property-read \App\Models\PaymentMethod $paymentMethod
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
     * @property-read int|null $products_count
     * @property-read \App\Models\User $user
     * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Order query()
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereFastDelivery($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereFirstName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereLastName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethodId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
     */
    class Order extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\PaymentMethod
     *
     * @property int $id
     * @property string $code
     * @property string $name
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Order $order
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod query()
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereUpdatedAt($value)
     */
    class PaymentMethod extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Product
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property float $price
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Basket[] $baskets
     * @property-read int|null $baskets_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
     * @property-read int|null $orders_count
     * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product query()
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
     */
    class Product extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $username
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Basket|null $Basket
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
     * @property-read int|null $orders_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
     */
    class User extends \Eloquent
    {
    }
}

