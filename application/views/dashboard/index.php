

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title_page ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="<?= base_url('main/form_pengajuan') ?>" type="button" class="btn btn-sm btn-outline-primary">Tambah Data</a>
          </div>
        </div>
      </div>


      <div class="table-responsive">
        <table class="table table-striped table-sm" id="example">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nomor</th>
              <th scope="col">Nama</th>
              <th scope="col">NIK</th>
              <th scope="col">Bagian</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Keperluan</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Status TTD</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </main>

  
