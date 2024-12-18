<?= $this->extend('layout/temp'); ?>

<?= $this->section('content'); ?>

<style>
    .class-detail {
        margin-top: 30px;
    }

    h2 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #333;
    }

    p {
        font-size: 18px;
        color: #666;
    }

    /* Styling for the tabs */
    .tabs {
        margin-top: 25px;
    }

    .tab-link {
        background-color: #333;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        font-size: 1rem;
        transition: 0.3s ease;
    }

    .tab-link:hover {
        background-color: #555;
    }

    .tab-link.active-tab {
        background-color: #555;
        /* font-weight: bold; */
    }


    #members h3 {
        text-align: center;
        padding-bottom: 10px;
        color: #333;
        font-size: 19px;

    }

    #tasks {
        margin-top: 20px;
        /* background-color: #f9f9f9; */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #tasks h3 {
        font-size: 19px;
        color: #333;
        margin-bottom: 15px;
        padding: 10px;
        text-align: center;
    }

    #tasks ul {
        list-style-type: none;
        padding-left: 0;
    }

    #tasks ul li {
        background-color: #fff;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 6px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    #tasks ul li:hover {
        background-color: #f1f1f1;
    }

    #tasks ul li a {
        text-decoration: none;
        font-weight: bold;
    }

    #tasks ul li a:hover {
        text-decoration: underline;
    }

    #tasks ul li .btn {
        display: inline-block;
        margin-top: 10px;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    #tasks ul li .btn:hover {
        background-color: #45a049;
        text-decoration: none;
    }

    .tab-content {
        display: none;
        padding: 30px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 20px;
    }

    /* Default open content styling */
    .tab-content:first-child {
        display: block;
    }

    /* Members and tasks list styling */
    /* ul {
        list-style: none;
        padding: 0;
    } */

    /* ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 1rem;
        color: #333;
    } */

    /* Hover effect on list items */
    /* ul li:hover {
        background-color: #f9f9f9;
    } */

    /* Create Task Tab Content */
    #create_task {
        margin-top: 20px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Form Header */
    #create_task h3 {
        color: #333;
        font-size: 19px;
        margin-bottom: 20px;
        margin-top: 10px;
        text-align: center;
    }

    /* Input Group Styles */
    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        font-size: 16px;
        color: #555;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .input-group input[type="text"],
    .input-group textarea,
    .input-group input[type="file"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    /* Change input border color on focus */
    .input-group input[type="text"]:focus,
    .input-group textarea:focus,
    .input-group input[type="file"]:focus {
        border-color: #4CAF50;
        outline: none;
    }

    textarea {
        resize: vertical;
        height: 150px;
    }

    /* Button Styles */
    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #45a049;
    }

    /* Mobile responsiveness */
    @media screen and (max-width: 768px) {
        .tabs {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tab-link {
            margin-bottom: 10px;
            width: 80%;
        }

        h2 {
            font-size: 24px;
        }

        p {
            font-size: 14px;
        }

        #create_task {
            padding: 15px;
        }

        #create_task h3 {
            font-size: 22px;
        }

        .btn {
            width: 50%;
            padding: 12px;
            font-size: 18px;
        }

        .input-group input,
        .input-group textarea {
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 14px;
        }
    }
</style>

<div class="wrapper">
    <main class="content">
        <div class="class-detail">
            <h2>Detail Kelas: <?= esc($class_data['class_name']) ?></h2>
            <p><strong>Deskripsi:</strong> <?= esc($class_data['class_description']) ?></p>

            <!-- Tabs for Members and Tasks -->
            <div class="tabs">
                <button class="tab-link" onclick="openTab('members')">Anggota</button>
                <button class="tab-link" onclick="openTab('tasks')">Tugas Kelas</button>
                <?php if ($user_role === 'pengajar'): ?>
                    <button class="tab-link" onclick="openTab('create_task')">Buat Tugas</button>
                <?php endif; ?>
            </div>

            <!-- Members Section -->
            <div id="members" class="tab-content">
                <h3>Anggota Kelas</h3>
                <ul>
                    <?php foreach ($members as $member): ?>
                        <li><?= esc($member['username']) ?> - <?= esc($member['role']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Tasks Section -->
            <div id="tasks" class="tab-content">
                <h3>Tugas Kelas</h3>
                <ul>
                    <?php foreach ($tasks as $task): ?>
                        <li>
                            <?= esc($task['task_name']) ?> - <?= esc($task['task_description']) ?>
                            <?php if ($task['attachment_path']): ?>
                                <br><a href="<?= base_url($task['attachment_path']) ?>" target="_blank">Lihat Lampiran</a>
                            <?php endif; ?>
                            <br><a href="<?= base_url("dashboard_pengajar/detailkelas/tugaskelas/" . $task['id']) ?>" class="btn">Edit</a> <!-- Perbaikan Edit Link -->
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Task Creation Form for Teachers -->
            <?php if ($user_role === 'pengajar'): ?>
                <div id="create_task" class="tab-content">
                    <h3>Buat Tugas Baru</h3>
                    <form action="<?= base_url("/kelas/createTask/$class_id") ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <label for="task_name">Nama Tugas:</label>
                            <input type="text" name="task_name" id="task_name" required>
                        </div>
                        <div class="input-group">
                            <label for="task_description">Deskripsi Tugas:</label>
                            <textarea name="task_description" id="task_description" required></textarea>
                        </div>
                        <div class="input-group">
                            <label for="attachment">Lampiran:</label>
                            <input type="file" name="attachment" id="attachment">
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn">Buat Tugas</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
    function openTab(tabName) {
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach((tab) => tab.style.display = 'none');
        document.getElementById(tabName).style.display = 'block';

        const tabLinks = document.querySelectorAll('.tab-link');
        tabLinks.forEach((button) => button.classList.remove('active-tab'));
        event.target.classList.add('active-tab');
    }

    document.addEventListener('DOMContentLoaded', function() {
        openTab('members'); // Default tab
    });
</script>

<?= $this->endSection(); ?>