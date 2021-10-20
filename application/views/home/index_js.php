<!-- dropzone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        load_data();
    });

    const BASE = "<?= base_url() ?>";
    const URL = BASE + "home/";

    Dropzone.autoDiscover = false;
    $('div#dropzone_me').dropzone({
        url: URL + 'upload',
        maxFiles: 10,
        maxFilesize: 9000,
        success: function(file, response) {

            this.removeFile(file);

            var res = JSON.parse(response);
            if (res.status == 'success') {
                toastr.success(res.msg);
                load_data();
            } else {
                toastr.error(res.msg);
            }
        },
        sending: function(file, xhr, formData) {
            formData.append("data_name", 'adnan');
        }
    });

    $('body').on('click', '.tombol_download', function(e) {
        e.preventDefault();
        download_data(this);
    });

    $('body').on('click', '.tombol_hapus', function(e) {
        e.preventDefault();
        hapus_data(this);
    });
</script>

<script>
    function load_data() {
        $.ajax({
            type: "GET",
            url: URL + "load_data",
            dataType: "JSON",
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status == 'success') {

                    var data = res.data;
                    var html = '';

                    if (data.length == 0) {
                        html += `
                            <tr>
                                <td class="text-center" colspan="3">tidak ada data</td>
                            </tr>
                        `;
                    }

                    $.map(data, function(e, i) {

                        html += `
                            <tr>
                                <td>${e.name}</td>
                                <td>${e.size}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button data-path="${e.path}" type="button" class="btn btn-primary btn-sm tombol_download">
                                            <i class="fa fa-download"></i>
                                        </button>
                                        <button data-path="${e.path}" type="button" class="btn btn-danger btn-sm tombol_hapus">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;

                    });

                    $('#table_data tbody').html(html);

                } else {
                    toastr.error('gagal load data');
                }
            }
        });
    }

    function download_data(form) {
        var path = $(form).data('path');
        var link = BASE + path;
        window.open(link, '_blank');
    }

    function hapus_data(form) {

        Swal.fire({
            title: 'Hapus Data ?',
            text: "Data akan dihapus dari sistem",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                var path = $(form).data('path');

                var data = new FormData();
                data.append('path', path);

                $.ajax({
                    type: "POST",
                    url: URL + "delete",
                    data: data,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == 'success') {

                            toastr.success(res.msg);
                            load_data();

                        } else {
                            toastr.error('gagal hapus data');
                        }
                    }
                });
            } else {
                return false;
            }
        })
    }
</script>