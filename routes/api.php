<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\RequestApprovalController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\CompanyController;

// Auth routes (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require JWT token)
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Student CRUD
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // Dashboard
    Route::get('/dashboard/sales', [DashboardController::class, 'sales']);

    // Admissions
    Route::apiResource('admissions', AdmissionController::class);
    Route::patch('/admissions/{admission}/status', [AdmissionController::class, 'updateStatus']);

    // Finance
    Route::prefix('finance')->group(function () {
        Route::apiResource('transactions', FinanceController::class);
        Route::get('summary', [FinanceController::class, 'summary']);
        Route::get('invoices', [FinanceController::class, 'invoices']);
        Route::get('scholarships', [FinanceController::class, 'scholarships']);
    });

    // Projects
    Route::apiResource('projects', ProjectController::class);

    // Communication
    Route::prefix('communication')->group(function () {
        Route::apiResource('messages', CommunicationController::class);
    });

    // Support / Tickets
    Route::prefix('support')->group(function () {
        Route::apiResource('tickets', SupportController::class);
        Route::patch('tickets/{ticket}/status', [SupportController::class, 'updateStatus']);
    });

    // Requests & Approvals
    Route::apiResource('requests', RequestApprovalController::class);
    Route::patch('/requests/{request}/action', [RequestApprovalController::class, 'action']);

      // Marketing Banners
    Route::prefix('marketing')->group(function () {
        Route::apiResource('banners', MarketingController::class);
        Route::patch('banners/{banner}/toggle', [MarketingController::class, 'toggle']);
    });

    // Academic Management
    Route::prefix('academic')->group(function () {
        Route::apiResource('courses', AcademicController::class);
        Route::get('timetable', [AcademicController::class, 'timetable']);
        Route::get('faculty', [AcademicController::class, 'faculty']);
        Route::get('syllabus', [AcademicController::class, 'syllabus']);
    });

    // Companies (Placements)
    Route::apiResource('companies', CompanyController::class);
});