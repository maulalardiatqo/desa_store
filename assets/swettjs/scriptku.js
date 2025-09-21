const flashData = $("#flash-data").data("flashdata");
const typeAlert = $("#flash-data").data("typealert");
console.log(typeAlert,"typeAlert")

if (flashData) {
	Swal.fire(
		flashData,"",typeAlert,
	);
}

$('.tombol-hapus').on('click', function(e){
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Yakin Mau Menghapus?',
		text: "Data Akan dihapus",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data'
	  }).then((result) => {
		if (result.isConfirmed) {
		  document.location.href = href;
		}
	  })
});
// const btnSaveJadwal = document.getElementById("saveJadwal");

// let jadwalAll = [];

// btnSaveJadwal.addEventListener("click", (e) => {
// 	let data = new FormData();
// 	let startdate = document.getElementsByName("startdate")[0].value;
// 	let enddate = document.getElementsByName("enddate")[0].value;
// 	let idGuru = document.getElementsByName("guru")[0].value;

// 	data.append("hari", document.getElementsByName("hari")[0].value);
// 	data.append("id_mapel", document.getElementsByName("mapel")[0].value);
// 	data.append("id_guru", idGuru);
// 	data.append("jam", startdate + " - " + enddate);
// 	data.append("id_kelas", document.getElementsByName("kelas")[0].value);
// 	let isAvailable = false;
// 	for (let index = 0; index < jadwalAll.length; index++) {
// 		const element = jadwalAll[index];
// 		if (idGuru == element.id_guru) {
// 			isAvailable = true;
// 		}
// 	}
// 	console.log(document.getElementsByName("hari")[0].value);

// 	let option = {
// 		method: "POST", // *GET, POST, PUT, DELETE, etc.
// 		mode: "no-cors", // no-cors, *cors, same-origin
// 		cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
// 		credentials: "same-origin", // include, *same-origin, omit
// 		headers: {
// 			"Content-Type": "application/json",
// 			// 'Content-Type': 'application/x-www-form-urlencoded',
// 		},

// 		body: data, // body data type must match "Content-Type" header
// 	};
// 	if (isAvailable) {
// 		Swal.fire("Fail", "Guru Tersebut Sudah ada jadwal", "error");
// 	} else {
// 		fetch("http://localhost/skripsi_lms/aplikasi/admin/tambahjadwal", option)
// 			.then((res) => {
// 				return res.json();
// 			})
// 			.then((result) => {
// 				console.log(result);
// 				if (result.status) {
// 					Swal.fire("Good job!", "Schedule has been Setted", "success");
// 				} else {
// 					Swal.fire("Fail", "Schedule Failed Setted", "error");
// 				}
// 				fetchData();
// 				$("#exampleModal").modal("hide");
// 			});
// 	}
// });

// function fetchData() {
// 	fetch("http://localhost/skripsi_lms/aplikasi/admin/atur_jad/1")
// 		.then((res) => {
// 			return res.json();
// 		})
// 		.then((result) => {
// 			settingViewJadwal(result);
// 			jadwalAll = result.jadwalPerhari;
// 			console.log(jadwalAll);
// 		});
// }
// fetchData();

// const contJadwal = document.getElementById("containerJadwal");
// function settingViewJadwal(result) {
// 	let template = `${result.jadwal.map((res) => {
// 		let items = ["success", "info", "warning"];
// 		var item = items[Math.floor(Math.random() * items.length)];
// 		return `<div class="col-md-4 mb-3 h-4">
// 					<div class="card">
// 						<div class="card-header bg-${item}">
// 							<h6 style="color: aliceblue;"> <b>${res.hari}</b> </h6>
// 						</div>
// 						<div class="card-body">
// 							<table class="table table-bordered table-sm">
// 								<thead>
// 									<tr>
// 									<th scope="col">No</th>
// 									<th scope="col">Mapel</th>
// 									<th scope="col">Jam</th>
// 									<th scope="col">Guru</th>
// 									</tr>
// 								</thead>
								
// 								<tbody>
// 								${result.jadwalPerhari.map((jw, index) => {
// 									if (jw.hari == res.hari) {
// 										return `<tr>
// 												<td>${index}</td>	
// 												<td>${jw.nama_mapel}</td>
// 												<td>${jw.jam}</td>
// 												<td>${jw.nama_guru}</td>   
// 											</tr>`;
// 									}
// 								})}
// 								</tbody>
// 							</table>
// 						</div>
// 				</div>
// 			</div>`;
// 	})}`;

// 	let clear = template.replaceAll(",", "");
// 	contJadwal.innerHTML = clear;
// }

// `<tr>
// 												<td>${i}</td>
// 												<td>${result.jadwalPerhari[i].nama_mapel}</td>
// 												<td>${result.jadwalPerhari[i].jam}</td>
// 												<td>${result.jadwalPerhari[i].nama_guru}</td>
// 											</tr>`;
