<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | إدارة القاعات</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-body: #0b0f19;
            --bg-sidebar: #111827;
            --bg-card: #1f2937;
            --bg-input: #111827;
            --text-primary: #f9fafb;
            --text-secondary: #9ca3af;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --border-color: #374151;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #06b6d4;
            --danger: #ef4444;
            --card-glow: rgba(99, 102, 241, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar Style */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand i {
            font-size: 1.5rem;
            color: var(--accent-color);
        }

        .sidebar-brand span {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #a5b4fc, var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--text-primary);
        }

        .sidebar-link.active i {
            color: var(--accent-color);
        }

        /* Main Workspace */
        .main-content {
            margin-right: 260px;
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* Topbar Style */
        .topbar {
            height: 70px;
            background-color: var(--bg-sidebar);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
        }

        .profile-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 1rem;
        }

        /* Content Container */
        .content-container {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: transparent;
        }

        .stat-card.total::after { background: var(--accent-color); }
        .stat-card.desktop-only::after { background: var(--warning); }
        .stat-card.desktop-mobile::after { background: var(--info); }
        .stat-card.permanent::after { background: var(--success); }

        .stat-info h4 {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stat-info p {
            font-size: 1.75rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-card.total .stat-icon { background-color: rgba(99, 102, 241, 0.1); color: var(--accent-color); }
        .stat-card.desktop-only .stat-icon { background-color: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-card.desktop-mobile .stat-icon { background-color: rgba(6, 182, 212, 0.1); color: var(--info); }
        .stat-card.permanent .stat-icon { background-color: rgba(16, 185, 129, 0.1); color: var(--success); }

        /* Filter Section */
        .filter-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.25rem;
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

        .search-input-wrapper i {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-input {
            width: 100%;
            padding: 0.8rem 2.8rem 0.8rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-input);
            color: var(--text-primary);
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        /* Table Section */
        .table-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
            background-color: rgba(17, 24, 39, 0.5);
            padding: 1rem 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.01);
        }

        /* Badges */
        .status-badge {
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .status-2 { background-color: rgba(245, 158, 11, 0.1); color: var(--warning); border: 1px solid rgba(245, 158, 11, 0.2); }
        .status-3 { background-color: rgba(6, 182, 212, 0.1); color: var(--info); border: 1px solid rgba(6, 182, 212, 0.2); }
        .status-4 { background-color: rgba(16, 185, 129, 0.1); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); }
        .status-default { background-color: rgba(156, 163, 175, 0.1); color: var(--text-secondary); border: 1px solid rgba(156, 163, 175, 0.2); }

        /* Actions Grid/Row */
        .actions-group {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .action-icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-sidebar);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .action-icon-btn:hover {
            color: var(--text-primary);
        }

        .action-icon-btn.btn-s2:hover { background-color: rgba(245, 158, 11, 0.15); color: var(--warning); border-color: var(--warning); }
        .action-icon-btn.btn-s3:hover { background-color: rgba(6, 182, 212, 0.15); color: var(--info); border-color: var(--info); }
        .action-icon-btn.btn-s4:hover { background-color: rgba(16, 185, 129, 0.15); color: var(--success); border-color: var(--success); }
        .action-icon-btn.btn-dt:hover { background-color: rgba(99, 102, 241, 0.15); color: var(--accent-color); border-color: var(--accent-color); }

        /* Modal popup styles */
        .custom-modal {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .custom-modal.show { display: flex; }

        .modal-body {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
            max-width: 440px;
            width: 90%;
            position: relative;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .modal-title-wrapper {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title-wrapper h3 { font-size: 1.2rem; font-weight: 700; }

        .close-modal-btn {
            background: none; border: none; color: var(--text-secondary); cursor: pointer; font-size: 1.25rem;
        }

        .close-modal-btn:hover { color: var(--text-primary); }

        .form-label { display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--text-secondary); }

        .form-control-date {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-sidebar);
            color: var(--text-primary);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Success alerts toast */
        .toast-notification {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            background-color: #064e3b;
            border: 1px solid var(--success);
            color: #d1fae5;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            z-index: 1001;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            animation: slideInLeft 0.3s ease;
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .pagination-container {
            padding: 1.25rem;
            display: flex;
            justify-content: center;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive */
        @media(max-width: 992px) {
            .sidebar { display: none; }
            .main-content { margin-right: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar Section -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <i class="fa-solid fa-gem"></i>
        <span>زفة - Zeffa</span>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="#" class="sidebar-link active">
                <i class="fa-solid fa-chart-line"></i>
                <span>لوحة التحكم</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-users"></i>
                <span>إدارة المستخدمين</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-sliders"></i>
                <span>الإعدادات</span>
            </a>
        </li>
    </ul>
</aside>

<!-- Main content section -->
<main class="main-content">
    <header class="topbar">
        <div class="topbar-title">لوحة تحكم المشرف</div>
        <div class="topbar-actions">
            <button class="profile-btn">
                <div class="profile-img">A</div>
                <span>المدير العام</span>
            </button>
        </div>
    </header>

    <div class="content-container">
        
        <!-- Stats Summary Cards -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-info">
                    <h4>إجمالي القاعات</h4>
                    <p>{{ $stats['total'] }}</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-hotel"></i>
                </div>
            </div>

            <div class="stat-card desktop-only">
                <div class="stat-info">
                    <h4>تطبيق سطح المكتب</h4>
                    <p>{{ $stats['desktop_only'] }}</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-desktop"></i>
                </div>
            </div>

            <div class="stat-card desktop-mobile">
                <div class="stat-info">
                    <h4>مكتب + هاتف</h4>
                    <p>{{ $stats['desktop_mobile'] }}</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </div>
            </div>

            <div class="stat-card permanent">
                <div class="stat-info">
                    <h4>تفعيل دائم</h4>
                    <p>{{ $stats['permanent'] }}</p>
                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-award"></i>
                </div>
            </div>
        </div>

        <!-- Filter/Search Bar -->
        <div class="filter-card">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="search-form">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ $search }}" class="search-input" placeholder="ابحث باسم المستخدم، البريد الإلكتروني، أو اسم القاعة...">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-search"></i> بحث
                </button>
                @if(!empty($search))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">إلغاء الفلترة</a>
                @endif
            </form>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-user"></i> اسم المستخدم</th>
                            <th><i class="fa-solid fa-building"></i> اسم القاعة</th>
                            <th><i class="fa-solid fa-location-dot"></i> العنوان</th>
                            <th><i class="fa-solid fa-envelope"></i> البريد الإلكتروني</th>
                            <th><i class="fa-solid fa-phone"></i> رقم الهاتف</th>
                            <th><i class="fa-solid fa-calendar-days"></i> تاريخ الانتهاء</th>
                            <th><i class="fa-solid fa-shield"></i> الحالة</th>
                            <th><i class="fa-solid fa-gears"></i> الإجراءات والتحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td style="font-weight: 600;">{{ $user->username }}</td>
                                <td>{{ $user->hallname ?? '—' }}</td>
                                <td>{{ $user->adresse ?? '—' }}</td>
                                <td style="font-family: 'Outfit';">{{ $user->email }}</td>
                                <td style="font-family: 'Outfit';">{{ $user->numperPhone ?? '—' }}</td>
                                <td style="font-family: 'Outfit';">
                                    {{ $user->date_experiment ? \Carbon\Carbon::parse($user->date_experiment)->format('Y-m-d') : 'غير محدد' }}
                                </td>
                                <td>
                                    @if($user->status == 2)
                                        <span class="status-badge status-2"><i class="fa-solid fa-desktop"></i> سطح المكتب فقط</span>
                                    @elseif($user->status == 3)
                                        <span class="status-badge status-3"><i class="fa-solid fa-circle-check"></i> مكتب وهاتف</span>
                                    @elseif($user->status == 4)
                                        <span class="status-badge status-4"><i class="fa-solid fa-star"></i> تفعيل دائم</span>
                                    @else
                                        <span class="status-badge status-default"><i class="fa-solid fa-circle-minus"></i> غير مفعل ({{ $user->status }})</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-group">
                                        <!-- Status 2 -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="action-icon-btn btn-s2" title="العمل على سطح المكتب فقط">
                                                <i class="fa-solid fa-desktop"></i>
                                            </button>
                                        </form>

                                        <!-- Status 3 -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="3">
                                            <button type="submit" class="action-icon-btn btn-s3" title="العمل على الهاتف والكمبيوتر">
                                                <i class="fa-solid fa-mobile-screen"></i>
                                            </button>
                                        </form>

                                        <!-- Status 4 -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="4">
                                            <button type="submit" class="action-icon-btn btn-s4" title="تفعيل دائم">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </button>
                                        </form>

                                        <!-- Date Edit -->
                                        <button class="action-icon-btn btn-dt" onclick="openDateModal('{{ $user->id }}', '{{ $user->username }}', '{{ $user->date_experiment }}')" title="تغيير تاريخ الانتهاء">
                                            <i class="fa-solid fa-calendar-pen"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 3rem;">
                                    <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; color: var(--text-secondary); margin-bottom: 1rem; display: block;"></i>
                                    <p style="color: var(--text-secondary);">لا يوجد قاعات لعرضها.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="pagination-container">
                    {{ $users->appends(['search' => $search])->links() }}
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Date picker Modal -->
<div class="custom-modal" id="dateModal">
    <div class="modal-body">
        <div class="modal-title-wrapper">
            <h3 id="modalTitle">تغيير تاريخ انتهاء الصلاحية</h3>
            <button class="close-modal-btn" onclick="closeDateModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="modalForm" method="POST">
            @csrf
            <div>
                <label for="date_experiment" class="form-label">تاريخ الصلاحية الجديد:</label>
                <input type="date" name="date_experiment" id="date_experiment" class="form-control-date" required>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeDateModal()">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>

<!-- Success Toast Notification -->
@if(session('success'))
    <div class="toast-notification" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<script>
    function openDateModal(id, username, date) {
        const modal = document.getElementById('dateModal');
        const form = document.getElementById('modalForm');
        const title = document.getElementById('modalTitle');
        const input = document.getElementById('date_experiment');

        form.action = `/admin/dashboard/users/${id}/expiration`;
        title.innerText = `تغيير تاريخ الصلاحية لـ: ${username}`;
        
        if(date) {
            input.value = date.split(' ')[0];
        } else {
            input.value = '';
        }

        modal.classList.add('show');
    }

    function closeDateModal() {
        document.getElementById('dateModal').classList.remove('show');
    }

    // Auto close toast
    window.addEventListener('load', () => {
        const toast = document.getElementById('toast');
        if(toast) {
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }
    });
</script>
</body>
</html>
