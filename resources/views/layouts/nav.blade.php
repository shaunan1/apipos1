<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #121212; /* Warna latar belakang gelap */
            color: #ffffff; /* Warna teks putih */
            display: flex; /* Menggunakan flexbox untuk layout */
        }
        nav {
            width: 200px; /* Lebar sidebar */
            background-color: #1e1e1e; /* Warna latar belakang navigasi */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5); /* Bayangan untuk kedalaman */
            height: 100vh; /* Tinggi penuh viewport */
            position: fixed; /* Memastikan sidebar tetap di tempat */
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            border-bottom: 1px solid #333; /* Garis pemisah antar item */
        }
        nav ul li a {
            color: #ffffff; /* Warna teks tautan */
            text-decoration: none; /* Menghilangkan garis bawah */
            padding: 15px; /* Ruang di sekitar teks */
            display: block; /* Membuat tautan menjadi blok untuk seluruh area */
            transition: background-color 0.3s; /* Transisi halus untuk hover */
        }
        nav ul li a:hover {
            background-color: #3700b3; /* Warna latar belakang saat hover */
        }
        .content {
            margin-left: 220px; /* Memberikan ruang untuk sidebar */
            padding: 20px; /* Ruang di sekitar konten */
            flex-grow: 1; /* Membuat konten mengisi sisa ruang */
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="{{ route('customers.index') }}">Customers</a></li>
            <li><a href="{{ route('order-items.index') }}">Order Items</a></li>
            <li><a href="{{ route('orders.index') }}">Orders</a></li>
            <li><a href="{{ route('payments.index') }}">Payments</a></li>
            <li><a href="{{ route('products.index') }}">Products</a></li>
        </ul>
    </nav>
</body>
</html>