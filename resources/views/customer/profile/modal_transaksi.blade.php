<!-- Transaction Detail Modal -->
<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTransaksiModalLabel" style="color: #014A3F;">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="mb-3" style="color: #014A3F;"><strong>Informasi Transaksi</strong></h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="40%">No. Transaksi</td>
                                <td><strong id="modal-trx-no"></strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td id="modal-trx-date"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span id="modal-trx-status" class="badge"></span></td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td id="modal-trx-payment"></td>
                            </tr>
                            <tr>
                                <td>Cleaner</td>
                                <td id="modal-trx-cleaner"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3" style="color: #014A3F;"><strong>Informasi Pelanggan</strong></h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="40%">Nama</td>
                                <td><strong id="modal-cust-name"></strong></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td id="modal-cust-phone"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td id="modal-cust-address"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h6 class="mb-3" style="color: #014A3F;"><strong>Detail Pesanan</strong></h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #f5f5f5;">
                            <tr>
                                <th>Layanan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="modal-trx-services-body">
                            <!-- Rows akan diisi JS -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td><strong id="modal-trx-total"></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
