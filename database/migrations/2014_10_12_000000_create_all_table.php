<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        //////////////////////////////////////////////////////////////////////
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('phonecode');
            $table->timestamps();
        });


        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('country_id')
            ->constrained('countries')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            
            $table->timestamps();
        });


        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('state_id')
            ->constrained('states')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->timestamps();
        });


        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique();
            $table->string('code', 50)->unique();
            $table->string('symbol', 5)->nullable();
            $table->timestamps();
        });

        //////////////////////////////////////////////////////////////////////

        Schema::create('servicesCatogries', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image');
            $table->boolean('isActive');
            $table->timestamps();
        });

        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->foreignId('serviceCatogrey_id')
                ->constrained('servicesCatogries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('isActive');
            $table->timestamps();
        });

        Schema::create('moreServices', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->foreignId('specialization_id')
                ->constrained('specializations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('isActive');
            $table->timestamps();
        });

        

        //////////////////////////////////////////////////////////////////////










        ///////////////////////////////////////////////////////////////////////
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');

            $table->foreignId('country_id')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('state_id')
                ->constrained('states')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('city_id')
                ->constrained('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade')->nullable();

                $table->tinyInteger('gender');


            $table->boolean('isActive');

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen')->nullable();

            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });



        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            
            $table->string('image');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isActive');

            $table->timestamps();
        });


        Schema::create('serviceProviders', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->longText('bio');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('idCard_photo');

            
            $table->foreignId('serviceCatogrey_id')
                ->constrained('ServicesCatogries')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreignId('specialization_id')
                ->constrained('specializations')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('country_id')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreignId('state_id')
                ->constrained('states')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('city_id')
                ->constrained('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->tinyInteger('gender');

                $table->decimal('wallet',9,2)->nullable();

            $table->boolean('isActive');


            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen')->nullable();

            $table->rememberToken();

            $table->timestamps();
        });




        //////////////////////////////////////////////////////////////////////

        // Schema::create('admins', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');

        //     $table->timestamps();
        // });



        //////////////////////////////////////////////////////////////////////

        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->longText('comment');

            $table->timestamps();
        });

        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('rate');

            $table->timestamps();
        });

        //////////////////////////////////////////////////////////////////////
        Schema::create('termsAndConditions', function (Blueprint $table) {
            $table->id();
            $table->longText('describe_ar');
            $table->longText('describe_en');

            $table->timestamps();
        });

        Schema::create('orderConditions', function (Blueprint $table) {
            $table->id();
            $table->longText('describe_ar');
            $table->longText('describe_en');

            $table->timestamps();
        });

        Schema::create('acceptOrderConditions', function (Blueprint $table) {
            $table->id();
            $table->longText('describe_ar');
            $table->longText('describe_en');

            $table->timestamps();
        });

        //////////////////////////////////////////////////////////////////////

        Schema::create('ordersStatus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descUser_ar');
            $table->string('descUser_en');
            $table->string('descProvider_ar');
            $table->string('descProvider_en');

            $table->timestamps();
        });


        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('ordersStatus_id')
                ->constrained('ordersStatus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->longText('describe');

            $table->timestamps();
        });

        //////////////////////////////////////////////////////////////////////
        Schema::create('reportsComments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreignId('comment_id')
                ->constrained('comments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->longText('reason');
            $table->boolean('isActive');

            $table->timestamps();
        });


        Schema::create('reportsProfiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->longText('reason');
            $table->string('photo')->nullable();;
            $table->boolean('isActive');

            $table->timestamps();
        });



        //////////////////////////////////////////////////////////////////////

        Schema::create('moreServicesOfServiceProviders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('moreService_id')
                ->constrained('moreServices')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });




        Schema::create('ServiceProvidersViews', function (Blueprint $table) {
            $table->id();

            $table->macAddress('mac');

            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });


        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            
            
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');


            $table->foreignId('serviceProvider_id')
                ->constrained('serviceProviders')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });



        Schema::create('WebsiteViews', function (Blueprint $table) {
            $table->id();

            $table->macAddress('mac');


            $table->timestamps();
        });


        //////////////////////////////////////////////////////////////////////
        Schema::create('website_config', function (Blueprint $table) {
            $table->id();
            
            $table->string('logo');
            $table->string('website_name');
            $table->longText('meta_descAr');
            $table->longText('meta_descEn');
            $table->boolean('isActive');

            $table->timestamps();
        });
                //////////////////////////////////////////////////////////////////////
                Schema::create('contact_us', function (Blueprint $table) {
                    $table->id();
                    
                    $table->string('name');
                    $table->string('email');
                    $table->longText('message');
                    $table->string('file')->nullable();

                    $table->boolean('isActive');
        
                    $table->timestamps();
                });
                    //////////////////////////////////////////////////////////////////////
                    Schema::create('mails', function (Blueprint $table) {
                        $table->id();
                        
                        $table->string('email');
                        $table->longText('message');
            
                        $table->timestamps();
                    });
    
    
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
        Schema::dropIfExists('contact_us');
        Schema::dropIfExists('website_config');
        Schema::dropIfExists('WebsiteViews');
        Schema::dropIfExists('favourites');
        Schema::dropIfExists('ServiceProvidersViews');
        Schema::dropIfExists('moreServicesOfServiceProviders');
        Schema::dropIfExists('reportsProfiles');
        Schema::dropIfExists('reportsComments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('ordersStatus');
        Schema::dropIfExists('AcceptOrderConditions');
        Schema::dropIfExists('orderConditions');
        Schema::dropIfExists('termsAndConditions');
        Schema::dropIfExists('rates');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('serviceProviders');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
        Schema::dropIfExists('moreServices');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('servicesCatogries');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
    }  
};
