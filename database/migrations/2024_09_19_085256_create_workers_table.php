<?php

use App\Models\Agency;
use App\Models\Worker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->uuid('worker_uuid')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('pin');
            $table->string('suffix_name')->nullable();
            $table->string('passport_number')->unique();
            $table->date('passport_expiry_date');
            $table->string('visa_type')->nullable();
            $table->text('visa_number')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->string('national_id_number')->nullable();
            $table->text('residency_address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->foreignIdFor(Agency::class);
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
