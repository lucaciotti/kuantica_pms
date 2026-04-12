<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $state
 * @property string|null $date
 * @property float|null $qty
 * @property float|null $qty_end
 * @property float|null $qty_res
 * @property string|null $batch_code
 * @property string|null $type_production
 * @property string|null $note
 * @property int|null $product_id
 * @property int|null $department_id
 * @property int|null $customer_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \App\Enums\OrderStatus $status
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereBatchCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereQtyEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereQtyRes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTypeProduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $filename
 * @property string $path
 * @property string $status
 * @property string $date_upload
 * @property string|null $date_last_import
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereDateLastImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereDateUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderImportFile whereUpdatedAt($value)
 */
	class OrderImportFile extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property string|null $unit
 * @property string|null $unit1
 * @property string|null $unit2
 * @property string|null $unit3
 * @property float|null $fatt1
 * @property float|null $fatt2
 * @property float|null $fatt3
 * @property int|null $product_range_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductBarcode> $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \App\Models\ProductRange|null $productRange
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereFatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereFatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereFatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductRangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUnit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUnit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUnit3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string|null $unit
 * @property int|null $product_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductBarcode whereUpdatedAt($value)
 */
	class ProductBarcode extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRange whereUpdatedAt($value)
 */
	class ProductRange extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property int|null $department_id
 * @property-read \App\Models\Department|null $department
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, ?string $guard = null)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser, \Kirschbaum\Commentions\Contracts\Commenter {}
}

