<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Profil Desa</h4>
                    <button type="button" id="btnEdit" class="btn btn-primary">Edit</button>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="needs-validation" method="POST" action="<?= base_url('admin/saveProfileDesa') ?>">
                            <div class="row">
                                <!-- Tentang Desa -->
                                <div class="col-xl-12">
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label">Tentang Desa <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" rows="6" name="tentang" id="tentang" disabled><?= $tentang ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- WhatsApp -->
                                <div class="col-xl-6">
    <div class="mb-3 row">
        <label class="col-lg-4 col-form-label">No WhatsApp</label>
        <div class="col-lg-8">
            <input type="text" 
                   class="form-control" 
                   name="whatsapp" 
                   id="whatsapp"
                   value="<?= $whatsapp ?>" disabled>
        </div>
    </div>
</div>

                                <!-- Instagram -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label">Link Instagram</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="instagram" value="<?= $instagram ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Facebook -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label">Link Facebook</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="facebook" value="<?= $facebook ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label">Link Email</label>
                                        <div class="col-lg-8">
                                            <input type="email" class="form-control" name="email" value="<?= $email ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-12 text-end">
                                    <button type="submit" id="btnSave" class="btn btn-success d-none">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("btnEdit").addEventListener("click", function() {
    let inputs = document.querySelectorAll("input, textarea");
    inputs.forEach(el => el.removeAttribute("disabled"));
    document.getElementById("btnSave").classList.remove("d-none");
    this.classList.add("d-none"); // sembunyikan tombol Edit
});
document.addEventListener("DOMContentLoaded", function() {
    const waInput = document.getElementById("whatsapp");

    waInput.addEventListener("input", function() {
        // hapus semua karakter selain angka
        this.value = this.value.replace(/[^0-9]/g, '');

        // kalau belum ada "62" di depan, tambahkan otomatis
        if (!this.value.startsWith("62")) {
            this.value = "62" + this.value.replace(/^62/, "");
        }
    });

    // saat pertama kali load, pastikan diawali 62
    if (!waInput.value.startsWith("62")) {
        waInput.value = "62" + waInput.value.replace(/^62/, "");
    }
});
</script>
