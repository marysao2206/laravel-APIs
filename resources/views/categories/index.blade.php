<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --page-bg: #ffffff;
            --surface: #ffffff;
            --line: #e5e7eb;
            --line-strong: #b8b8b8;
            --text: #4b5563;
            --heading: #222222;
            --muted: #6b7280;
            --brand: #19c3e8;
            --brand-dark: #1098b7;
            --success: #238a3d;
            --info: #18a0f3;
            --danger: #d94646;
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(180deg, #fff8f8 0%, #ffffff 22%);
            font-family: "Instrument Sans", "Segoe UI", sans-serif;
            color: var(--text);
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 18px 16px 48px;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 66px;
            height: 30px;
            padding: 0 12px;
            border-radius: 4px;
            border: 1px solid var(--brand-dark);
            background: linear-gradient(180deg, #27d7f5 0%, var(--brand) 100%);
            color: #083344;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(25, 195, 232, 0.22);
        }

        .create-btn:hover {
            filter: brightness(0.98);
        }

        .table-wrap {
            background: var(--surface);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead th {
            text-align: left;
            font-size: 14px;
            line-height: 1.2;
            font-weight: 700;
            color: var(--heading);
            padding: 10px 16px 12px;
            border-bottom: 1px solid var(--line-strong);
        }

        tbody td {
            padding: 10px 16px;
            font-size: 14px;
            line-height: 1.35;
            border-bottom: 1px solid var(--line);
            vertical-align: middle;
        }

        .col-id {
            width: 70px;
        }

        .col-name {
            width: 240px;
        }

        .col-action {
            width: 160px;
            text-align: center;
        }

        .description {
            color: #555;
            word-break: break-word;
        }

        .actions {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.15s ease, opacity 0.15s ease;
        }

        .action-link:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .action-icon {
            width: 16px;
            height: 16px;
            display: inline-block;
        }

        .separator {
            color: #7c8a95;
            margin: 0 2px;
            user-select: none;
        }

        .view {
            color: var(--success);
        }

        .edit {
            color: var(--info);
        }

        .delete {
            color: var(--danger);
        }

        .empty-state {
            padding: 18px 16px;
            color: var(--muted);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .page {
                padding-inline: 10px;
            }

            table {
                min-width: 720px;
            }

            .table-scroller {
                overflow-x: auto;
                border: 1px solid var(--line);
                border-radius: 8px;
                box-shadow: var(--shadow);
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="toolbar">
            <a class="create-btn" href="#" aria-label="Create category">create+</a>
        </div>

        <div class="table-scroller">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="col-id">#</th>
                            <th class="col-name">Name</th>
                            <th>Description</th>
                            <th class="col-action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="description">{{ $category->description ?? '-' }}</td>
                                <td class="col-action">
                                    <div class="actions" aria-label="Category actions">
                                        <a href="#" class="action-link view" title="View">
                                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <circle cx="12" cy="12" r="2.5" fill="currentColor"/>
                                            </svg>
                                        </a>
                                        <span class="separator">|</span>
                                        <a href="#" class="action-link edit" title="Edit">
                                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <span class="separator">|</span>
                                        <a href="#" class="action-link delete" title="Delete">
                                            <svg class="action-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M4 7h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M9 7V5.8A1.8 1.8 0 0 1 10.8 4h2.4A1.8 1.8 0 0 1 15 5.8V7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M6 7l1 12h10l1-12" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                                <path d="M10 11v5M14 11v5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">No categories found yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
