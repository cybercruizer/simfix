<!-- Modal Update Barang-->
<div class="modal fade" id="modalUpdateBarang{{ $barang->kode_barang }}" tabindex="-1" aria-labelledby="modalUpdateBarang"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM UPDATE BARANG-->
                <form action="/beranda-yo/{{ $barang->kode_barang }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="updateNamaBarang" name="updateNamaBarang"
                            value="{{ $barang->nama_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="text" class="form-control" id="updateJumlahBarang" name="updateJumlahBarang"
                            value="{{ $barang->jumlah_barang }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div>
<!-- End Modal UPDATE Barang-->
