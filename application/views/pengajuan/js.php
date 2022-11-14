<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      } else {
        let nomor = $('#nomorPengajuan').val(),
            nama  = $('#namaLengkap').val(),
            nik  = $('#nik').val(),
            bagian  = $('#bagian').val(),
            tgl  = $('#tanggalPengajuan').val(),
            status_kep  = $('input[name="keperluanRadio"]:checked').val(),
            status_ket  = $('input[name="ketRadio"]:checked').val(),
            status_ttd  = $('input[name="ttdRadio"]:checked').val(),

            lain_lain = '',
            getTtd_personalia = '',
            getTtd_manager = ''

        if (status_kep == '9') {
          lain_lain =  $('#input-lainlain').val()
        }
        if (status_ttd == '1') {
          getTtd_personalia = $('textarea[name="output-personalia"]').text()
          getTtd_manager = $('textarea[name="output-manager"]').text()
        }

        $.ajax({
          url : '<?= base_url('main/process_pengajuan') ?>',
          method: 'POST',
          data : {
            'nomor': nomor,
            'nama': nama,
            'nik': nik,
            'bagian': bagian,
            'tgl': tgl,
            'flag_kep': status_kep,
            'flag_ket': status_ket,
            'flag_ttd': status_ttd,
            'lain_lain': lain_lain,
            'ttd_personalia': getTtd_personalia,
            'ttd_manager': getTtd_manager,
          },
          success: function(response){
            console.log('response', response == 1)
            if (response == 1) {
              $('rect').attr('fill', '#15de21')
              $('.toast-body').html('Berhasil Menambahkan Data')
              $('.toast').toast('show')

            } else {
              $('rect').attr('fill', '#e01212')
              $('.toast-body').html('Gagal Menambahkan Data')

              $('.toast').toast('show')
            }
          }

        })

        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })

})()


const checkKeperluan = async (e) => {
  let containerLainlain = document.querySelector('#container-lainlain')
  if (e.getAttribute('id') == 'Lainlain') {
    containerLainlain.innerHTML = `
        <div class="col-md-6">
          <input type="text" class="form-control col-sm-6" id="input-lainlain" placeholder="" required>
        </div>`;
  } else {
    containerLainlain.innerHTML = '';
  }
}

const checkStatusTtd = async (e) => {
  let containerTtd = document.querySelector('#container-ttd')
  if (e.getAttribute('id') == 'otomatis') {
    containerTtd.innerHTML = `
        <div class="col-md-6">
          <label for="cc-name" class="form-label">Ttd Dept. Personalia</label>
          <input type="file" class="form-control" id="file_personalia" data-target="output-personalia" onchange="openFile(event)" placeholder="" required>
          <textarea name="output-personalia" class="d-none"></textarea>
          <small class="text-muted">Gambar Harus kurang dari 500kb</small>
          <div class="invalid-feedback">
            Gambar Wajib di isi
          </div>
          <br>
          <img id="output-personalia" style="height:10rem; width:10rem;"/>
        </div>

        <div class="col-md-6">
          <label for="cc-name" class="form-label">Ttd Manager</label>
          <input type="file" class="form-control" id="file_manager" data-target="output-manager" onchange="openFile(event)" required>
          <textarea name="output-manager" class="d-none"></textarea>
          <small class="text-muted">Gambar Harus kurang dari 500kb</small>
          <div class="invalid-feedback">
            Gambar Wajib di isi
          </div>
          <br>
          <img id="output-manager" style="height:10rem; width:10rem;"/>
        </div>`;
  } else {
    containerTtd.innerHTML = '';
  }
}

const openFile = function(file) {

  let currentTarget = $(file.currentTarget);
  let outputTarget = currentTarget.attr('data-target');

  let input = file.target;
  let reader = new FileReader();

  reader.onloadend = function(){
    let dataURL = reader.result;
    let output = document.getElementById(outputTarget);
    output.src = dataURL;
    $('textarea[name="'+outputTarget+'"]').text(dataURL);
  };
  reader.readAsDataURL(input.files[0]);
};

</script>