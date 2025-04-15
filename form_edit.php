<?= $this->include('template/admin_header'); ?>

<h2 style="margin-bottom: 20px;"><?= $title; ?></h2>

<form action="" method="post">
    <p style="margin-bottom: 10px;">
        <input type="text" name="judul" value="<?= $data['judul']; ?>" required>
    </p>
    <p style="margin-bottom: 20px;">
        <textarea name="isi" cols="50" rows="10" required><?= $data['isi']; ?></textarea>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large btn-primary" style="background-color: #2b83ea; color: white;">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>