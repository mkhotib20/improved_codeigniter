<?= form_open_multipart(base_url().'welcome/gaga') ?>
<input type="file" name="image">
<br><small style="color: red">Peringatan</small>
<br><br><input type="text" name="nama" >
<br><input type="submit">
<?= form_close() ?>