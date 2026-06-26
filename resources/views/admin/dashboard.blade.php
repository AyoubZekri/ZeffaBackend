<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | إدارة القاعات</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: rgba(30, 41, 59, 0.7);
            --accent-primary: #6366f1;
            --accent-secondary: #4f46e5;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.08);
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --glass-blur: 16px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', 'Outfit', sans-serif;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--bg-primary);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-primary);
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Header */
        header {
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .logo-section h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #a5b4fc, #818cf8, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25rem;
        }

        .logo-section p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Search Section */
        .search-card {
            background: var(--bg-secondary);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .search-input {
            width: 100%;
            padding: 0.85rem 1.2rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: rgba(15, 23, 42, 0.6);
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.3);
        }

        .btn {
            padding: 0.85rem 1.8rem;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.6);
        }

        .btn-reset {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            text-decoration: none;
        }

        .btn-reset:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideDown 0.4s ease;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
        }

        @keyframes slideDown {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Table Card */
        .table-card {
            background: var(--bg-secondary);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th {
            background: rgba(15, 23, 42, 0.4);
            padding: 1.2rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
        }

        td {
            padding: 1.2rem 1rem;
            font-size: 0.95rem;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Badges */
        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-0 {
            background: rgba(148, 163, 184, 0.15);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.3);
        }

        .badge-2 {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-3 {
            background: rgba(6, 182, 212, 0.15);
            color: #22d3ee;
            border: 1px solid rgba(6, 182, 212, 0.3);
        }

        .badge-4 {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Action Buttons */
        .actions-cell {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-status-2 {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-status-2:hover {
            background: var(--warning);
            color: var(--bg-primary);
        }

        .btn-status-3 {
            background: rgba(6, 182, 212, 0.1);
            color: #22d3ee;
            border: 1px solid rgba(6, 182, 212, 0.3);
        }

        .btn-status-3:hover {
            background: var(--info);
            color: var(--bg-primary);
        }

        .btn-status-4 {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-status-4:hover {
            background: var(--success);
            color: var(--bg-primary);
        }

        .btn-date {
            background: rgba(99, 102, 241, 0.1);
            color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .btn-date:hover {
            background: var(--accent-primary);
            color: white;
        }

        /* Modal / Dialog Overlay */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 1rem;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1e293b;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            max-width: 450px;
            width: 100%;
            padding: 2rem;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: modalPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalPop {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-close:hover {
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .datepicker-input {
            width: 100%;
            padding: 0.85rem 1rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 1rem;
        }

        .datepicker-input:focus {
            outline: none;
            border-color: var(--accent-primary);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 1.5rem;
            background: rgba(15, 23, 42, 0.2);
            border-top: 1px solid var(--border-color);
        }

        /* Empty state */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: var(--text-secondary);
        }

        .empty-state h3 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div class="logo-section">
            <h1>لوحة التحكم المتقدمة</h1>
            <p>إدارة الحسابات وتفعيل القاعات الفعالة (دور: Hall)</p>
        </div>
    </header>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('success-alert').remove()" style="background:none; border:none; color:inherit; cursor:pointer; font-size:1.2rem;">&times;</button>
        </div>
    @endif

    <!-- Search bar -->
    <div class="search-card">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <input type="text" name="search" value="{{ $search }}" class="search-input" placeholder="البحث بالبريد الإلكتروني، اسم المستخدم، أو اسم القاعة...">
            </div>
            <button type="submit" class="btn btn-primary">بحث</button>
            @if(!empty($search))
                <a href="{{ route('admin.dashboard') }}" class="btn btn-reset">إعادة تعيين</a>
            @endif
        </form>
    </div>

    <!-- Users Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>اسم المستخدم</th>
                        <th>اسم القاعة</th>
                        <th>العنوان</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>تاريخ انتهاء التجربة</th>
                        <th>الحالة</th>
                        <th>العمليات والتحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $user->username }}</div>
                            </td>
                            <td>{{ $user->hallname ?? '—' }}</td>
                            <td>{{ $user->adresse ?? '—' }}</td>
                            <td style="font-family: 'Outfit', sans-serif;">{{ $user->email }}</td>
                            <td style="font-family: 'Outfit', sans-serif;">{{ $user->numperPhone ?? '—' }}</td>
                            <td>
                                <span style="font-family: 'Outfit', sans-serif; font-weight: 500;">
                                    {{ $user->date_experiment ? \Carbon\Carbon::parse($user->date_experiment)->format('Y-m-d') : 'غير محدد' }}
                                </span>
                            </td>
                            <td>
                                @if($user->status == 2)
                                    <span class="badge badge-2">سطح المكتب فقط</span>
                                @elseif($user->status == 3)
                                    <span class="badge badge-3">سطح المكتب + الهاتف</span>
                                @elseif($user->status == 4)
                                    <span class="badge badge-4">تفعيل دائم</span>
                                @else
                                    <span class="badge badge-0">غير مفعل ({{ $user->status }})</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <!-- Status 2 Button -->
                                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn-action btn-status-2" title="العمل على تطبيق سطح المكتب فقط">مكتب فقط</button>
                                    </form>

                                    <!-- Status 3 Button -->
                                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn-action btn-status-3" title="العمل على سطح المكتب والهاتف">مكتب وهاتف</button>
                                    </form>

                                    <!-- Status 4 Button -->
                                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="4">
                                        <button type="submit" class="btn-action btn-status-4" title="تفعيل دائم للمستخدم">تفعيل دائم</button>
                                    </form>

                                    <!-- Date Picker Trigger Button -->
                                    <button class="btn-action btn-date" onclick="openDateModal('{{ $user->id }}', '{{ $user->username }}', '{{ $user->date_experiment }}')">
                                        تعديل التاريخ
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <h3>لا يوجد مستخدمين</h3>
                                    <p>لم يتم العثور على أي قاعات تطابق خيارات البحث الحالية.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="pagination-wrapper">
                {{ $users->appends(['search' => $search])->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Custom Calendar/Date Modal -->
<div class="modal" id="date-modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeDateModal()">&times;</button>
        <div class="modal-header">
            <h3 class="modal-title">تغيير تاريخ انتهاء الصلاحية</h3>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem;" id="modal-user-subtitle"></p>
        </div>
        <form id="date-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="date_experiment" class="form-label">اختر تاريخ الانتهاء الجديد:</label>
                <input type="date" name="date_experiment" id="date_experiment" class="datepicker-input" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-reset" onclick="closeDateModal()" style="padding: 0.6rem 1.2rem;">إلغاء</button>
                <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.2rem;">تحديث التاريخ</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDateModal(userId, username, currentDate) {
        const modal = document.getElementById('date-modal');
        const form = document.getElementById('date-form');
        const subtitle = document.getElementById('modal-user-subtitle');
        const dateInput = document.getElementById('date_experiment');

        // Set form action dynamic URL
        form.action = `/admin/dashboard/users/${userId}/expiration`;
        
        subtitle.textContent = `المستخدم: ${username}`;
        
        // Format date to YYYY-MM-DD
        if (currentDate) {
            const formattedDate = currentDate.split(' ')[0];
            dateInput.value = formattedDate;
        } else {
            dateInput.value = '';
        }

        modal.classList.add('active');
    }

    function closeDateModal() {
        const modal = document.getElementById('date-modal');
        modal.classList.remove('active');
    }

    // Auto-fade success alert
    window.addEventListener('DOMContentLoaded', () => {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 400);
            }, 4000);
        }
    });
</script>
</body>
</html>
