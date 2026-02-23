<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            // Address Information
            $table->string('street_address')->nullable();
            $table->string('street_address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();

            // Education
            $table->string('high_school')->nullable();
            $table->string('other_high_school')->nullable();
            $table->string('degree_field')->nullable();

            // Documents
            $table->string('transcript')->nullable();
            $table->string('sar')->nullable();
            $table->string('acceptance_letter')->nullable();

            // School Activity
            $table->string('school_activity_title')->nullable();
            $table->string('school_activity_year')->nullable();
            $table->string('school_activity_name')->nullable();
            $table->text('school_activity_description')->nullable();

            // Community Activity
            $table->string('community_activity_title')->nullable();
            $table->string('community_activity_year')->nullable();
            $table->string('community_activity_name')->nullable();
            $table->text('community_activity_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'street_address',
                'street_address_2',
                'city',
                'state',
                'zip_code',
                'high_school',
                'other_high_school',
                'degree_field',
                'transcript',
                'sar',
                'acceptance_letter',
                'school_activity_title',
                'school_activity_year',
                'school_activity_name',
                'school_activity_description',
                'community_activity_title',
                'community_activity_year',
                'community_activity_name',
                'community_activity_description'
            ]);
        });
    }
};
