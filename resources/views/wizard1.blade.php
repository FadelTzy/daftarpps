<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <link rel="stylesheet" href="assets/css/wizard.css">
    </head>
    <body style="text-align: center;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                	<form action="" method="post" class="f1">
                		<h3>Registrasi Awal</h3>
                		<p>Tahap</p>
                		<div class="f1-steps">
                			<div class="f1-progress">
                			    <div class="f1-progress-line" data-now-value="20" data-number-of-steps="5" style="width: 20%;"></div>
                			</div>
                            <div class="f1-step active">
                                <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                <p>Informasi Diri</p>
                            </div>
                			<div class="f1-step">
                				<div class="f1-step-icon"><i class="fa fa-home"></i></div>
                				<p>Informasi Kontak</p>
                			</div>
                			<div class="f1-step">
                				<div class="f1-step-icon"><i class="fa fa-key"></i></div>
                				<p>Program Pendidikan</p>
                			</div>
                            <div class="f1-step">
                				<div class="f1-step-icon"><i class="fa fa-key"></i></div>
                				<p>Pendidikan Terakhir</p>
                			</div>
                		    <div class="f1-step">
                				<div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                				<p>Berkas</p>
                			</div>
                		</div>
                		<!-- step 1 -->
                		<fieldset>
                		    <h4>Informasi Diri</h4>
                			<div class="form-group">
                			    <label>Nama</label>
                                <input type="text" name="nama_awal" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control">
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="I">Islam</option>
                                    <option value="Kr">Kristen</option>
                                    <option value="Ka">Katolik</option>
                                    <option value="H">Hindu</option>
                                    <option value="B">Buddha</option>
                                    <option value="Ko">Konghuchu</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label>Status Kawin</label>
                                <select class="form-control">
                                    <option value="" disabled selected>Pilih Status Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <input type="text" name="nama_ibu" placeholder="Nama Ibu" class="form-control">
                            </div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <!-- step 2 -->
                        <fieldset>
                            <h4>Informasi Kontak</h4>
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control" required>
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Aceh">Aceh</option>
                                    <option value="Sumatera Utara">Sumatera Utara</option>
                                    <option value="Sumatera Barat">Sumatera Barat</option>
                                    <option value="Riau">Riau</option>
                                    <option value="Kepulauan Riau">Kepulauan Riau</option>
                                    <option value="Jambi">Jambi</option>
                                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                                    <option value="Bangka Belitung">Bangka Belitung</option>
                                    <option value="Bengkulu">Bengkulu</option>
                                    <option value="Lampung">Lampung</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="Bali">Bali</option>
                                    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                    <option value="Kalimantan Barat">Kalimantan Barat</option>
                                    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                    <option value="Kalimantan Timur">Kalimantan Timur</option>
                                    <option value="Kalimantan Utara">Kalimantan Utara</option>
                                    <option value="Sulawesi Utara">Sulawesi Utara</option>
                                    <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                    <option value="Gorontalo">Gorontalo</option>
                                    <option value="Sulawesi Barat">Sulawesi Barat</option>
                                    <option value="Maluku">Maluku</option>
                                    <option value="Maluku Utara">Maluku Utara</option>
                                    <option value="Papua">Papua</option>
                                    <option value="Papua Barat">Papua Barat</option>
                                    <option value="Papua Tengah">Papua Tengah</option>
                                    <option value="Papua Pegunungan">Papua Pegunungan</option>
                                    <option value="Papua Selatan">Papua Selatan</option>
                                    <option value="Papua Barat Daya">Papua Barat Daya</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>Kabupaten</label>
                                {{-- <input type="text" name="alamat_rumah" placeholder="Alamat Rumah" class="form-control"> --}}
                                <select id="kabupaten" class="form-control" name="kabupaten" required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    <option value="Makassar">Kota Makassar</option>
                                    <option value="Gowa">Kabupaten Gowa</option>
                                    <option value="Maros">Kabupaten Maros</option>
                                    <option value="Takalar">Kabupaten Takalar</option>
                                    <option value="Bone">Kabupaten Bone</option>
                                    <option value="Soppeng">Kabupaten Soppeng</option>
                                    <option value="Wajo">Kabupaten Wajo</option>
                                    <option value="Bulukumba">Kabupaten Bulukumba</option>
                                    <option value="Bantaeng">Kabupaten Bantaeng</option>
                                    <option value="Jeneponto">Kabupaten Jeneponto</option>
                                    <option value="Barru">Kabupaten Barru</option>
                                    <option value="Pangkajene dan Kepulauan">Kabupaten Pangkajene dan Kepulauan</option>
                                    <option value="Luwu">Kabupaten Luwu</option>
                                    <option value="Luwu Timur">Kabupaten Luwu Timur</option>
                                    <option value="Luwu Utara">Kabupaten Luwu Utara</option>
                                    <option value="Tana Toraja">Kabupaten Tana Toraja</option>
                                    <option value="Toraja Utara">Kabupaten Toraja Utara</option>
                                    <option value="Sinjai">Kabupaten Sinjai</option>
                                    <option value="Pinrang">Kabupaten Pinrang</option>
                                    <option value="Enrekang">Kabupaten Enrekang</option>
                                    <option value="Sidrap">Kabupaten Sidenreng Rappang (Sidrap)</option>
                                    <option value="Palopo">Kota Palopo</option>
                                    <option value="Parepare">Kota Parepare</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="Bontoala">Kecamatan Bontoala</option>
                                    <option value="Makassar">Kecamatan Makassar</option>
                                    <option value="Tallo">Kecamatan Tallo</option>
                                    <option value="Ujung Pandang">Kecamatan Ujung Pandang</option>
                                    <option value="Ujung Tanah">Kecamatan Ujung Tanah</option>
                                    <option value="Panakkukang">Kecamatan Panakkukang</option>
                                    <option value="Rappocini">Kecamatan Rappocini</option>
                                    <option value="Tamalanrea">Kecamatan Tamalanrea</option>
                                    <option value="Manggala">Kecamatan Manggala</option>
                                    <option value="Biringkanaya">Kecamatan Biringkanaya</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="text" name="kode_pos" placeholder="Kode Pos" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <input type="text" name="alamat" placeholder="Alamat Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP 1</label>
                                <input type="text" name="no_hp1" placeholder="Nomor HP 1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP 2</label>
                                <input type="text" name="no_hp2" placeholder="Nomor HP 2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telp. Rumah</label>
                                <input type="text" name="no_telp_rumah" placeholder="Nomor Telepon Rumah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP Kerabat</label>
                                <input type="text" name="no_hp_kerabat" placeholder="Nomor HP Kerabat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                            </div>
                            {{-- <div class="form-group">
                                <label>Kecamatan</label>
                                <textarea name="alamat_kantor" placeholder="Alamat Kantor" class="form-control"></textarea>
                            </div> --}}

                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <!-- step 3 -->
                        <fieldset>
                            <h4>Program Pendidikan</h4>
                            <div class="form-group">
                                <label>Jenjang</label>
                                <select id="jenjang_pilihan" name="jenjang_pilihan" class="form-control" required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="program_studi" name="program_tudi" required>
                                    <option value="">Pilih Program Studi</option>
                                    <option value="Magister Manajemen">Magister Manajemen (MM)</option>
                                    <option value="Magister Akuntansi">Magister Akuntansi (MAk)</option>
                                    <option value="Magister Teknik Informatika">Magister Teknik Informatika (MTI)</option>
                                    <option value="Magister Pendidikan">Magister Pendidikan (MPd)</option>
                                    <option value="Magister Hukum">Magister Hukum (MH)</option>
                                    <option value="Magister Ilmu Komunikasi">Magister Ilmu Komunikasi (MIK)</option>
                                    <option value="Magister Administrasi Publik">Magister Administrasi Publik (MAP)</option>
                                    <option value="Magister Teknik Sipil">Magister Teknik Sipil (MTS)</option>
                                    <option value="Magister Kesehatan Masyarakat">Magister Kesehatan Masyarakat (MKM)</option>
                                </select>
                            </div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <h4>Pendidikan Terakhir</h4>
                            <div class="form-group">
                                <label>Jenjang</label>
                                <select id="jenjang_akhir" name="jenjang_akhir" class="form-control" required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Universitas Asal (S1/S2)</label>
                                <select class="form-control" id="universitas" name="universitas" required>
                                    <option value="">Pilih Universitas</option>
                                    <option value="Universitas Indonesia">Universitas Indonesia (UI)</option>
                                    <option value="Institut Teknologi Bandung">Institut Teknologi Bandung (ITB)</option>
                                    <option value="Universitas Gadjah Mada">Universitas Gadjah Mada (UGM)</option>
                                    <option value="Institut Pertanian Bogor">Institut Pertanian Bogor (IPB University)</option>
                                    <option value="Institut Teknologi Sepuluh Nopember">Institut Teknologi Sepuluh Nopember (ITS)</option>
                                    <option value="Universitas Airlangga">Universitas Airlangga (UNAIR)</option>
                                    <option value="Universitas Padjadjaran">Universitas Padjadjaran (UNPAD)</option>
                                    <option value="Universitas Diponegoro">Universitas Diponegoro (UNDIP)</option>
                                    <option value="Universitas Brawijaya">Universitas Brawijaya (UB)</option>
                                    <option value="Universitas Sebelas Maret">Universitas Sebelas Maret (UNS)</option>
                                </select>   
                            </div>
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text" name="nim" placeholder="NIM" class="form-control">
                            </div>
                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </fieldset>
                        <!-- step 4 -->
                        <fieldset>
                            <h4>Berkas</h4>
                            <div class="form-group">
                                <label for="uploadPasFoto">Pas Foto</label>
                                <input type="file" id="uploadPasFoto" name="uploadPasFoto" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="uploadKTPAsli">KTP Asli</label>
                                <input type="file" id="uploadKTPAsli" name="uploadKTPAsli" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="uploadFotocopyIjazah">Fotocopy Ijazah terakhir</label>
                                <input type="file" id="uploadFotocopyIjazah" name="uploadFotocopyIjazah" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="uploadFotocopyIjazah">Fotocopy Ijazah terakhir</label>
                                <input type="file" id="uploadFotocopyIjazah" name="uploadFotocopyIjazah" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="uploadFotocopyTranskrip">Fotocopy Transkrip</label>
                                <input type="file" id="uploadFotocopyTranskrip" name="uploadFotocopyTranskrip" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="aktaKelahiran">Akta Kelahiran</label>
                                <input type="file" id="aktaKelahiran" name="aktaKelahiran" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="kartuKeluarga">Kartu Keluarga</label>
                                <input type="file" id="kartuKeluarga" name="kartuKeluarga" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>
                            <div class="form-group">
                                <label for="suratPernyataan">Surat Permytaan</label>
                                <input type="file" id="suratPernyataan" name="suratPernyataan" class="form-control" accept="image/*">
                                <p class="help-block">Pilih file gambar (format: JPG, PNG, GIF).</p>
                            </div>

                            <div class="f1-buttons">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Submit</button>
                            </div>
                        </fieldset>
                	</form>
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="assets/js/wizard.js"></script>
    </body>
</html>