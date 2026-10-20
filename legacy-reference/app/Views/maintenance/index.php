<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>We'll Be Right Back - ROXPEDIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu;
            background: #0f172a;
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 620px;
            padding: 28px 20px;
            text-align: center;
        }

        h1 {
            font-size: clamp(32px, 6vw, 56px);
            margin-bottom: 10px;
            letter-spacing: -1.2px;
            line-height: 1.1;
            text-shadow: 0 6px 20px rgba(0,0,0,0.35);
        }

        h2 {
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
            margin-bottom: 22px;
            letter-spacing: 0.6px;
        }

        .tabs {
            display: inline-flex;
            border: 1px solid #334155;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 26px;
        }

        .tab {
            padding: 8px 18px;
            cursor: pointer;
            font-size: 13px;
            color: #cbd5f5;
            background: #020617;
            border-right: 1px solid #334155;
            user-select: none;
        }

        .tab:last-child {
            border-right: none;
        }

        .tab.active {
            background: #1e293b;
            color: #e0e7ff;
            font-weight: 600;
        }

        .content {
            display: none;
            animation: fadeIn 0.2s ease-in-out;
        }

        .content.active {
            display: block;
        }

        p {
            font-size: 16px;
            line-height: 1.65;
            color: #cbd5f5;
            margin-bottom: 18px;
        }

        .divider {
            width: 64px;
            height: 3px;
            background: #6366f1;
            margin: 24px auto;
            border-radius: 10px;
        }

        .support {
            margin-top: 28px;
            font-size: 14px;
            color: #a5b4fc;
        }

        .support a {
            color: #818cf8;
            text-decoration: none;
            border-bottom: 1px dashed #818cf8;
        }

        .support a:hover {
            opacity: 0.85;
        }

        .footer {
            margin-top: 36px;
            font-size: 13px;
            color: #94a3b8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        function switchTab(lang) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));

            document.getElementById('tab-' + lang).classList.add('active');
            document.getElementById('content-' + lang).classList.add('active');
        }
    </script>
</head>
<body>

<div class="container">
    <h1>We'll Be Right Back</h1>
    <h2>ROXPEDIA TEAM</h2>

    <div class="tabs">
        <div id="tab-en" class="tab active" onclick="switchTab('en')">EN</div>
        <div id="tab-id" class="tab" onclick="switchTab('id')">ID</div>
    </div>

    <div class="divider"></div>

    <!-- ================= ENGLISH ================= -->
    <div id="content-en" class="content active">
        <p>
            After more than a year of continuous development and refinement,
            ROXPEDIA is currently paused following careful consideration.
        </p>

        <p>
            While active development is paused, certain parts of the project
            remain operational and require ongoing maintenance.
        </p>

        <p>
            Development will resume when ROXPEDIA is ready
            to move forward sustainably.
        </p>
    </div>

    <!-- ================= INDONESIA ================= -->
    <div id="content-id" class="content">
        <p>
            Setelah berjalan lebih dari satu tahun melalui proses pengembangan
            dan penyempurnaan berkelanjutan, ROXPEDIA saat ini dihentikan sementara
            melalui pertimbangan yang matang.
        </p>

        <p>
            Meskipun pengembangan aktif dihentikan sementara,
            beberapa bagian proyek tetap berjalan
            dan memerlukan perawatan berkelanjutan.
        </p>

        <p>
            Pengembangan akan dilanjutkan kembali
            ketika fondasi proyek telah siap
            untuk berjalan secara berkelanjutan.
        </p>

        <p>
            Sampai saat itu, terima kasih
            atas dukungan dan kebersamaan Anda.
        </p>
    </div>

    <div class="support">
        For those who wish to support the continuation of this project:
        <br><br>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="<?= site_url('documentation'); ?>">Documentation</a>
        <a href="https://sociabuzz.com/cherubim/support" target="_blank" rel="noopener">
            Support ROXPEDIA
        </a>
    </div>

    <div class="footer">
        Thank you for visiting ROXPEDIA.
    </div>
</div>

</body>
</html>

