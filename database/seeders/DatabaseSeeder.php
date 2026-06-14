<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name'       => 'Admin',
            'email'      => 'admin@school.com',
            'password'   => Hash::make('password'),
            'role'       => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Courses
        $courses = [
            ['name' => 'B.Tech Computer Science', 'code' => 'BTCS', 'duration' => '4 Years', 'seats' => 60, 'enrolled' => 54, 'faculty' => 'Dr. Mehta'],
            ['name' => 'MBA',                     'code' => 'MBA',  'duration' => '2 Years', 'seats' => 40, 'enrolled' => 38, 'faculty' => 'Prof. Sharma'],
            ['name' => 'BBA',                     'code' => 'BBA',  'duration' => '3 Years', 'seats' => 50, 'enrolled' => 45, 'faculty' => 'Dr. Patel'],
            ['name' => 'MCA',                     'code' => 'MCA',  'duration' => '2 Years', 'seats' => 30, 'enrolled' => 28, 'faculty' => 'Dr. Joshi'],
            ['name' => 'B.Com',                   'code' => 'BCOM', 'duration' => '3 Years', 'seats' => 60, 'enrolled' => 55, 'faculty' => 'Prof. Gupta'],
        ];
        foreach ($courses as $c) {
            DB::table('courses')->insert(array_merge($c, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Admissions
        $admissions = [
            ['name' => 'Riya Shah',   'email' => 'riya@example.com',   'course' => 'B.Tech CSE', 'batch' => '2024-28', 'status' => 'Approved',     'applied_on' => '2024-06-10'],
            ['name' => 'Arjun Patel', 'email' => 'arjun@example.com',  'course' => 'MBA',        'batch' => '2024-26', 'status' => 'Pending',      'applied_on' => '2024-06-09'],
            ['name' => 'Priya Mehta', 'email' => 'priya@example.com',  'course' => 'BBA',        'batch' => '2024-27', 'status' => 'Approved',     'applied_on' => '2024-06-08'],
            ['name' => 'Rahul Desai', 'email' => 'rahul@example.com',  'course' => 'MCA',        'batch' => '2024-26', 'status' => 'Under Review', 'applied_on' => '2024-06-07'],
            ['name' => 'Sneha Joshi', 'email' => 'sneha@example.com',  'course' => 'B.Com',      'batch' => '2024-27', 'status' => 'Approved',     'applied_on' => '2024-06-06'],
            ['name' => 'Amit Kumar',  'email' => 'amit@example.com',   'course' => 'B.Tech CSE', 'batch' => '2024-28', 'status' => 'Rejected',     'applied_on' => '2024-06-05'],
            ['name' => 'Pooja Singh', 'email' => 'pooja@example.com',  'course' => 'MBA',        'batch' => '2024-26', 'status' => 'Approved',     'applied_on' => '2024-06-04'],
        ];
        foreach ($admissions as $a) {
            DB::table('admissions')->insert(array_merge($a, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Transactions
        $transactions = [
            ['student' => 'Riya Shah',   'type' => 'Fee Payment', 'amount' => 45000,  'method' => 'Online',  'status' => 'Paid',    'date' => '2024-06-10'],
            ['student' => 'Arjun Patel', 'type' => 'Fee Payment', 'amount' => 60000,  'method' => 'Cheque',  'status' => 'Pending', 'date' => '2024-06-09'],
            ['student' => 'Priya Mehta', 'type' => 'Scholarship', 'amount' => -15000, 'method' => 'System',  'status' => 'Applied', 'date' => '2024-06-08'],
            ['student' => 'Rahul Desai', 'type' => 'Fee Payment', 'amount' => 45000,  'method' => 'Cash',    'status' => 'Overdue', 'date' => '2024-06-07'],
            ['student' => 'Sneha Joshi', 'type' => 'Refund',      'amount' => -5000,  'method' => 'Online',  'status' => 'Processed','date' => '2024-06-06'],
            ['student' => 'Amit Kumar',  'type' => 'Fee Payment', 'amount' => 45000,  'method' => 'Online',  'status' => 'Paid',    'date' => '2024-06-05'],
        ];
        foreach ($transactions as $t) {
            DB::table('transactions')->insert(array_merge($t, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Projects
        $projects = [
            ['title' => 'Student Portal Redesign', 'department' => 'IT',             'lead' => 'Dr. Mehta',  'deadline' => '2024-07-30', 'progress' => 65, 'status' => 'Active',          'members' => 5],
            ['title' => 'Library Digitization',    'department' => 'Library',         'lead' => 'Mrs. Shah',  'deadline' => '2024-08-15', 'progress' => 40, 'status' => 'Active',          'members' => 3],
            ['title' => 'Smart Classroom Setup',   'department' => 'Infrastructure',  'lead' => 'Mr. Patel',  'deadline' => '2024-06-30', 'progress' => 90, 'status' => 'Near Completion', 'members' => 8],
            ['title' => 'Alumni Network Platform', 'department' => 'Admin',           'lead' => 'Dr. Joshi',  'deadline' => '2024-09-01', 'progress' => 20, 'status' => 'Planning',        'members' => 4],
        ];
        foreach ($projects as $p) {
            DB::table('projects')->insert(array_merge($p, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Tickets
        $tickets = [
            ['title' => 'Fee receipt not received',        'student' => 'Riya Shah',   'category' => 'Finance',   'priority' => 'High',   'status' => 'Open'],
            ['title' => 'Cannot access LMS portal',        'student' => 'Arjun Patel', 'category' => 'Technical', 'priority' => 'Medium', 'status' => 'In Progress'],
            ['title' => 'Wrong marks entered in result',   'student' => 'Priya Mehta', 'category' => 'Academic',  'priority' => 'High',   'status' => 'Resolved'],
            ['title' => 'Hostel room allocation issue',    'student' => 'Rahul Desai', 'category' => 'Admin',     'priority' => 'Low',    'status' => 'Open'],
            ['title' => 'Library card not issued',         'student' => 'Sneha Joshi', 'category' => 'Admin',     'priority' => 'Low',    'status' => 'Closed'],
        ];
        foreach ($tickets as $t) {
            DB::table('tickets')->insert(array_merge($t, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Companies
        $companies = [
            ['name' => 'Infosys Ltd.',    'sector' => 'IT',          'contact' => 'hr@infosys.com',    'placements' => 24, 'visits' => 3, 'status' => 'Active'],
            ['name' => 'Deloitte India',  'sector' => 'Consulting',  'contact' => 'campus@deloitte.com','placements' => 18, 'visits' => 2, 'status' => 'Active'],
            ['name' => 'HDFC Bank',       'sector' => 'Finance',     'contact' => 'campus@hdfc.com',   'placements' => 12, 'visits' => 1, 'status' => 'Active'],
            ['name' => 'Wipro Technologies','sector' => 'IT',         'contact' => 'hr@wipro.com',      'placements' => 20, 'visits' => 2, 'status' => 'Inactive'],
        ];
        foreach ($companies as $c) {
            DB::table('companies')->insert(array_merge($c, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Banners
        $banners = [
            ['title' => 'Admission Open 2024',      'placement' => 'Home Page Hero',   'start_date' => '2024-05-01', 'end_date' => '2024-07-31', 'status' => 'Active'],
            ['title' => 'Scholarship Announcement', 'placement' => 'Dashboard Banner', 'start_date' => '2024-06-01', 'end_date' => '2024-06-30', 'status' => 'Active'],
            ['title' => 'Alumni Meet 2024',          'placement' => 'Sidebar',          'start_date' => '2024-07-01', 'end_date' => '2024-07-15', 'status' => 'Scheduled'],
        ];
        foreach ($banners as $b) {
            DB::table('banners')->insert(array_merge($b, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Request Approvals
        $requests = [
            ['type' => 'Leave Application',  'requester' => 'Riya Shah',   'department' => 'B.Tech CSE', 'details' => 'Medical leave for 3 days',       'status' => 'Pending',  'date' => '2024-06-10'],
            ['type' => 'Certificate Request','requester' => 'Arjun Patel', 'department' => 'MBA',        'details' => 'Bonafide certificate required',   'status' => 'Approved', 'date' => '2024-06-09'],
            ['type' => 'Fee Waiver',         'requester' => 'Priya Mehta', 'department' => 'BBA',        'details' => 'Request for 10% waiver',          'status' => 'Pending',  'date' => '2024-06-08'],
            ['type' => 'Course Change',      'requester' => 'Rahul Desai', 'department' => 'MCA',        'details' => 'Transfer from CSE to IT',         'status' => 'Rejected', 'date' => '2024-06-07'],
        ];
        foreach ($requests as $r) {
            DB::table('request_approvals')->insert(array_merge($r, ['created_at' => now(), 'updated_at' => now()]));
        }

        // RPL Cases
        $rplCases = [
            ['student' => 'Riya Shah',   'course' => 'B.Tech CSE', 'credits_applied' => 24, 'credits_approved' => 20, 'status' => 'Approved',     'date' => '2024-06-05'],
            ['student' => 'Arjun Patel', 'course' => 'MBA',        'credits_applied' => 12, 'credits_approved' => null,'status' => 'Under Review', 'date' => '2024-06-08'],
            ['student' => 'Priya Mehta', 'course' => 'BBA',        'credits_applied' => 18, 'credits_approved' => 15, 'status' => 'Approved',     'date' => '2024-06-02'],
        ];
        foreach ($rplCases as $r) {
            DB::table('rpl_cases')->insert(array_merge($r, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Re-evaluations
        $reEvals = [
            ['student' => 'Riya Shah',   'subject' => 'Data Structures',       'exam' => 'End Semester', 'current_marks' => 38, 'revised_marks' => null, 'status' => 'Pending',      'applied_on' => '2024-06-10'],
            ['student' => 'Arjun Patel', 'subject' => 'Financial Management',  'exam' => 'Mid Semester', 'current_marks' => 45, 'revised_marks' => null, 'status' => 'Under Review', 'applied_on' => '2024-06-09'],
            ['student' => 'Priya Mehta', 'subject' => 'Marketing Management',  'exam' => 'End Semester', 'current_marks' => 52, 'revised_marks' => 58,   'status' => 'Completed',    'applied_on' => '2024-06-08'],
        ];
        foreach ($reEvals as $r) {
            DB::table('re_evaluations')->insert(array_merge($r, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Messages
        $messages = [
            ['to' => 'All Students',     'subject' => 'Exam Schedule Released', 'body' => 'Please check the updated exam schedule on the portal.', 'type' => 'Notice', 'status' => 'Sent', 'sent_at' => '2024-06-10'],
            ['to' => 'B.Tech CSE Batch', 'subject' => 'Lab Assignment Due',     'body' => 'Complete and submit your lab assignments by Friday.',     'type' => 'Email',  'status' => 'Sent', 'sent_at' => '2024-06-09'],
            ['to' => 'Parents',          'subject' => 'Fee Reminder',           'body' => 'Please clear pending fees before June 30.',               'type' => 'SMS',    'status' => 'Sent', 'sent_at' => '2024-06-08'],
        ];
        foreach ($messages as $m) {
            DB::table('messages')->insert(array_merge($m, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
