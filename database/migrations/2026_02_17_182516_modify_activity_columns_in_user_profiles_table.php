<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            // Drop old single columns
            $table->dropColumn([
                'school_activity_title',
                'school_activity_year',
                'school_activity_name',
                'school_activity_description',
                'community_activity_title',
                'community_activity_year',
                'community_activity_name',
                'community_activity_description',
            ]);

            // Add JSON columns
            $table->json('school_activity')->nullable();
            $table->json('community_activity')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            $table->dropColumn(['school_activity', 'community_activity']);

            // Re-add old columns if rollback
            $table->string('school_activity_title')->nullable();
            $table->string('school_activity_year')->nullable();
            $table->string('school_activity_name')->nullable();
            $table->text('school_activity_description')->nullable();

            $table->string('community_activity_title')->nullable();
            $table->string('community_activity_year')->nullable();
            $table->string('community_activity_name')->nullable();
            $table->text('community_activity_description')->nullable();
        });
    }
};
