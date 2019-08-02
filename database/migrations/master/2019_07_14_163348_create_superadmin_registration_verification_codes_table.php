<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSuperadminRegistrationVerificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superadmin_registration_verification_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email_applicant')/*->unique() foreign key is too long by laravel*/;
            $table->string('sms_verification_code');
            $table->string('email_verification_code');
            $table->timestamp('expired_at')->useCurrent(); // https://laracasts.com/discuss/channels/eloquent/why-table-timestamps-puts-on-update-current-timestamp-on-the-created-at-column;
            $table->timestamps();
        });

        //foreign key is too long by laravel
        DB::select(DB::raw("

            ALTER TABLE superadmin_registration_verification_codes
            ADD UNIQUE s_r_v_c_email_applicant_unique(email_applicant);

        "));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superadmin_registration_verification_codes');
    }
}
