<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kebencanaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar.active {
            margin-left: -250px;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #212529;
        }
        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #adb5bd;
            text-decoration: none;
        }
        #sidebar ul li a:hover {
            color: #fff;
            background: #495057;
        }
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff;
            background: #0d6efd;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .card-icon {
            font-size: 2.5rem;
            opacity: 0.3;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #sidebarCollapse span {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <h3><i class="fas fa-shield-alt"></i> Admin Panel</h3>
        </div>

        <ul class="list-unstyled components">
            <p class="text-center">Manajemen Bencana</p>
            <li>
                <a href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            </li>
            <li class="active">
                <a href="#"><i class="fas fa-table me-2"></i> Laporan Bencana</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-users me-2"></i> Manajemen Petugas</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-cogs me-2"></i> Pengaturan</a>
            </li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fas fa-align-left"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Naila Yohanda Putri
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h1 class="mb-4">📌 Kebencanaan & Tanggap Darurat</h1>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Kejadian</h5>
                            <p class="card-text fs-4">150</p>
                        </div>
                        <i class="fas fa-clipboard-list card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-dark bg-warning mb-3 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Dalam Penanganan</h5>
                            <p class="card-text fs-4">12</p>
                        </div>
                        <i class="fas fa-hourglass-half card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Selesai</h5>
                            <p class="card-text fs-4">138</p>
                        </div>
                        <i class="fas fa-check-circle card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                     <h5 class="card-title">Daftar Kejadian Bencana</h5>
                     <button class="btn btn-success"><i class="fas fa-plus-circle me-2"></i>Tambah Data</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Jenis Bencana</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Dampak</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kejadian as $item)
                                <tr>
                                    <td>{{ $item['kejadian_id'] }}</td>
                                    <td>{{ $item['jenis_bencana'] }}</td>
                                    <td>{{ $item['tanggal'] }}</td>
                                    <td>{{ $item['lokasi_text'] }}</td>
                                    <td>{{ $item['rt'] }}</td>
                                    <td>{{ $item['rw'] }}</td>
                                    <td>{{ $item['dampak'] }}</td>
                                    <td>
                                        @if($item['status'] == 'Selesai')
                                            <span class="badge bg-success">{{ $item['status'] }}</span>
                                        @elseif($item['status'] == 'Dalam Penanganan')
                                            <span class="badge bg-warning text-dark">{{ $item['status'] }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item['status'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['keterangan'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>1</td>
                                <td>Banjir</td>
                                <td>2025-09-28</td>
                                <td>Jl. Sudirman</td>
                                <td>01</td>
                                <td>02</td>
                                <td>20 Rumah terendam</td>
                                <td><span class="badge bg-warning text-dark">Dalam Penanganan</span></td>
                                <td>Tim SAR sudah di lokasi.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

</body>
</html>
