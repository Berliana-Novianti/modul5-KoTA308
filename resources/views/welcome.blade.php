<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Pelamar - KoTA 308</title>
    <style>
        body { font-family: sans-serif; padding: 50px; }
        form { border: 1px solid #ccc; padding: 20px; width: 300px; }
        input { margin-bottom: 10px; width: 100%; }
    </style>
</head>
<body>
    <h2>Form Pendaftaran (Modul 5)</h2>
    <form action="https://reimagined-halibut-7vvgq4qwj4g7hwp4-8000.app.github.dev/daftar" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        
        <label>Upload Foto KTP/CV:</label><br>
        <input type="file" name="foto" required><br>
        
        <button type="submit">Kirim ke Cloud</button>
    </form>
</body>
</html>