<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tickets',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('ip', 45);
                $table->string('domain');
                $table->integer('class_id')->unsigned();
                $table->integer('type_id')->unsigned();
                $table->integer('status_id')->unsigned();
                $table->integer('last_notify_count')->unsigned();
                $table->integer('last_notify_timestamp');

                $table->integer('ip_contact_account_id')->unsigned();
                $table->string('ip_contact_reference');
                $table->string('ip_contact_name');
                $table->string('ip_contact_email');
                $table->string('ip_contact_api_host');
                $table->string('ip_contact_api_key');
                $table->integer('ip_contact_notified_count')->unsigned();
                $table->boolean('ip_contact_auto_notify')->unsigned();

                $table->integer('domain_contact_account_id')->unsigned();
                $table->string('domain_contact_reference');
                $table->string('domain_contact_name');
                $table->string('domain_contact_email');
                $table->string('domain_contact_api_host');
                $table->string('domain_contact_api_key');
                $table->integer('domain_contact_notified_count')->unsigned();
                $table->boolean('domain_contact_auto_notify')->unsigned();

                $table->timestamps();
                $table->softDeletes();

                $table->index('ip');
                $table->index('domain');
                $table->index('class_id');
                $table->index('type_id');
                $table->index('ip_contact_reference');
                $table->index('domain_contact_reference');
                $table->index('status_id');

            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
