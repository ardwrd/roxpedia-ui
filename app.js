/* ROXPEDIA / Bootstrap 5.3 UI prototype. Gameplay details are illustrative, not verified. */
"use strict";
(function () {
  var monsters = [
    {id:"poring",name:"Poring",level:1,element:"Water",size:"Medium",race:"Plant",zone:"Prontera South Gate",hp:112,atk:"8–12",def:3,drops:["Jellopy","Sticky Mucus","Poring Card"]},
    {id:"lunatic",name:"Lunatic",level:3,element:"Neutral",size:"Small",race:"Brute",zone:"Prontera South Gate",hp:175,atk:"12–18",def:5,drops:["Feather","Lunatic Card"]},
    {id:"fabre",name:"Fabre",level:5,element:"Earth",size:"Small",race:"Insect",zone:"Prontera West Gate",hp:228,atk:"16–23",def:8,drops:["Fluff","Green Herb","Fabre Card"]},
    {id:"rocker",name:"Rocker",level:8,element:"Earth",size:"Medium",race:"Insect",zone:"Prontera West Gate",hp:300,atk:"21–31",def:12,drops:["Grasshopper Leg","Rocker Card"]},
    {id:"marine",name:"Marin",level:16,element:"Water",size:"Medium",race:"Plant",zone:"Payon Forest",hp:540,atk:"38–47",def:18,drops:["Sticky Mucus","Marin Card"]},
    {id:"wolf",name:"Wolf",level:24,element:"Earth",size:"Medium",race:"Brute",zone:"Payon Forest",hp:1080,atk:"72–95",def:36,drops:["Wolf Claw","Animal Skin","Wolf Card"]},
    {id:"isis",name:"Isis",level:47,element:"Shadow",size:"Large",race:"Demon",zone:"Pyramid",hp:5800,atk:"252–321",def:162,drops:["Scale Skin","Isis Card"]},
    {id:"argiope",name:"Argiope",level:62,element:"Poison",size:"Large",race:"Insect",zone:"Mjolnir Mountains",hp:12500,atk:"437–502",def:282,drops:["Cobweb","Poison Spore","Argiope Card"]}
  ];
  var topics = [
    {id:"monsters",n:"01",title:"Monster database",desc:"Level, atribut, lokasi, dan drop"},
    {id:"items",n:"02",title:"Item & cards",desc:"Equipment, material, dan kartu"},
    {id:"jobs",n:"03",title:"Jobs & skills",desc:"Pilihan job dan informasi skill"},
    {id:"tools",n:"04",title:"Calculators",desc:"Tools sederhana untuk perencanaan"},
    {id:"tracker",n:"05",title:"MVP / Mini tracker",desc:"Ruang dan jadwal aktivitas boss"},
    {id:"about",n:"06",title:"Tentang proyek",desc:"Status prototype dan panduan kontribusi"}
  ];
  var appEl = document.getElementById("app");
  var fmt = new Intl.NumberFormat("id-ID");
  function esc(s){return String(s).replace(/[&<>"']/g,function(c){return {"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]});}
  function avatar(m){return '<span class="record-avatar" aria-hidden="true">'+esc(m.name.slice(0,2).toUpperCase())+'</span>';}
  function tag(m){return '<span class="element-tag element-'+esc(m.element.toLowerCase())+'">'+esc(m.element)+'</span>';}
  function crumb(section){return '<div class="breadcrumbs"><a href="#/">Home</a><span>/</span>'+esc(section)+'</div>';}
  function top(label,title,desc,compact){return '<div class="page-top'+(compact?' compact':'')+'"><div class="page-kicker">'+esc(label)+'</div><h1>'+esc(title)+'</h1><p class="page-summary">'+esc(desc)+'</p></div>';}
  function searchBlock(){return '<form id="siteSearchForm" class="search-panel" role="search"><label class="search-label" for="siteSearch"><span>CARI DALAM DATABASE</span><kbd>/</kbd></label><div class="d-flex flex-column flex-sm-row gap-2"><input class="form-control search-control" id="siteSearch" type="search" autocomplete="off" placeholder="Nama monster, item, atau keyword…"><button class="btn btn-rox" type="submit">Cari data ↗</button></div></form>';}
  function heading(n,title,link,href){return '<div class="section-label"><h2><span class="section-index">'+n+'</span>'+esc(title)+'</h2>'+(link?'<a href="'+href+'">'+esc(link)+' ↗</a>':'')+'</div>';}
  function row(m){return '<tr><td><a class="record-link" href="#/monsters/'+encodeURIComponent(m.id)+'">'+avatar(m)+'<span>'+esc(m.name)+'</span></a></td><td class="fw-semibold">'+m.level+'</td><td>'+tag(m)+'</td><td>'+esc(m.size)+'</td><td class="muted">'+esc(m.race)+'</td><td class="muted">'+esc(m.zone)+'</td></tr>';}
  function mobileRow(m){return '<a class="mobile-record" href="#/monsters/'+encodeURIComponent(m.id)+'">'+avatar(m)+'<span><strong>'+esc(m.name)+'</strong><small>Lv. '+m.level+' · '+esc(m.element)+' · '+esc(m.size)+'</small></span><b aria-hidden="true">↗</b></a>';}
  function table(list){if(!list.length)return '<div class="empty-state">Tidak ada monster yang cocok. Coba kata kunci atau filter lain.</div>';return '<div class="d-none d-md-block table-responsive"><table class="table"><thead><tr><th scope="col">Monster</th><th scope="col">Level</th><th scope="col">Element</th><th scope="col">Size</th><th scope="col">Race</th><th scope="col">Location</th></tr></thead><tbody>'+list.map(row).join("")+'</tbody></table></div><div class="d-md-none">'+list.map(mobileRow).join("")+'</div>';}
  function home(){return crumb("Beranda")+top("MIDGARD REFERENCE","Referensi Ragnarok X","Akses database monster, item, job, serta tools dalam satu direktori. Navigasi dibuat ringkas agar pencarian informasi menjadi lebih cepat.")+searchBlock()+
    heading("01","Jelajahi direktori","Lihat monster","#/monsters")+
    '<div class="directory-grid mb-5">'+topics.slice(0,4).map(function(t){return '<a class="directory-link" href="#/'+t.id+'"><div class="directory-name">'+esc(t.title)+'<span aria-hidden="true">↗</span></div><div class="directory-desc">'+esc(t.desc)+'</div></a>';}).join("")+'</div>'+
    heading("02","Cuplikan monster","Buka database","#/monsters")+
    '<div class="panel">'+table(monsters.slice(0,5))+'</div><p class="data-caption">* Semua contoh level, lokasi, dan atribut di halaman ini adalah data demo yang belum diverifikasi terhadap game.</p>'+
    '<section class="mt-5">'+heading("03","Catatan pengembangan","","")+'<div class="soft-box mt-3">Prototype ini hanya mencakup struktur antarmuka. Integrasi data melalui API, aset monster resmi, versi game, dan fitur produksi akan dikerjakan secara terpisah.</div></section>';}
  function monstersPage(){
    var params=new URLSearchParams((location.hash.split("?")[1]||""));
    var q=params.get("q")||"";
    return crumb("Monster database")+top("DATABASE / 01","Monster database","Cari berdasarkan nama, elemen, atau lokasi. Buka salah satu monster untuk melihat susunan halaman detail dan statistik demonstrasi.",true)+
    '<div class="list-toolbar"><div class="filter-group"><div class="field search-field"><label for="filterSearch">Cari monster</label><input id="filterSearch" class="form-control" type="search" autocomplete="off" placeholder="Nama atau lokasi…" value="'+esc(q)+'"></div><div class="field"><label for="filterElement">Element</label><select class="form-select" id="filterElement"><option value="">Semua element</option>'+Array.from(new Set(monsters.map(function(m){return m.element}))).sort().map(function(x){return '<option value="'+esc(x)+'">'+esc(x)+'</option>'}).join("")+'</select></div><div class="field"><label for="filterSize">Size</label><select class="form-select" id="filterSize"><option value="">Semua size</option><option>Small</option><option>Medium</option><option>Large</option></select></div><div class="field"><label for="sortOrder">Urutkan</label><select id="sortOrder" class="form-select"><option value="level">Level terendah</option><option value="level-desc">Level tertinggi</option><option value="name">Nama A–Z</option></select></div></div><div class="list-meta" id="resultCount" role="status"></div></div>'+
    '<div class="panel" id="results"></div><p class="data-caption">* Statistik, klasifikasi dan lokasi adalah fixture contoh; jangan gunakan untuk keputusan gameplay.</p>';}
  function wireFilters(){
    var ids=["filterSearch","filterElement","filterSize","sortOrder"];
    function apply(){
      var q=document.getElementById("filterSearch").value.toLowerCase().trim();
      var e=document.getElementById("filterElement").value;
      var s=document.getElementById("filterSize").value;
      var o=document.getElementById("sortOrder").value;
      var list=monsters.filter(function(m){return (!q||(m.name+" "+m.zone+" "+m.element+" "+m.race).toLowerCase().includes(q))&&(!e||m.element===e)&&(!s||m.size===s);});
      list.sort(function(a,b){return o==="name"?a.name.localeCompare(b.name):o==="level-desc"?b.level-a.level:a.level-b.level;});
      document.getElementById("results").innerHTML=table(list);
      document.getElementById("resultCount").textContent=list.length+" / "+monsters.length+" RECORDS";
    }
    ids.forEach(function(id){document.getElementById(id).addEventListener(id==="filterSearch"?"input":"change",apply);});
    apply();
  }
  function detailPage(id){
    var m=monsters.find(function(x){return x.id===id});
    if(!m){return crumb("Monster database")+top("RECORD","Monster tidak ditemukan","Kembali ke direktori untuk mencari record lain.",true)+'<a class="btn btn-outline-rox" href="#/monsters">← Kembali ke database</a>';}
    return '<div class="breadcrumbs"><a href="#/">Home</a><span>/</span><a href="#/monsters">Monster database</a><span>/</span>'+esc(m.name)+'</div>'+
    '<div class="page-top compact"><div class="page-kicker">MONSTER DATABASE / DEMO RECORD</div><div class="record-head">'+avatar(m)+'<div><h1>'+esc(m.name)+'</h1><p class="page-summary">Record monster level '+m.level+' · '+esc(m.zone)+'</p></div></div></div>'+
    '<div class="row g-4"><div class="col-md-7"><div class="section-label"><h2>Informasi monster</h2></div><div class="panel mt-3"><div class="stat-grid">'+
    [['Level',m.level],['Element',m.element],['Size',m.size],['Race',m.race],['HP',fmt.format(m.hp)],['DEF',fmt.format(m.def)]].map(function(x){return '<div class="stat"><span>'+esc(x[0])+'</span><strong>'+esc(x[1])+'</strong></div>';}).join("")+
    '</div><div class="border-top p-3 small-note">Contoh serangan (ATK): '+esc(m.atk)+'</div></div>'+
    '<section class="detail-section"><h2>Lokasi</h2><div class="soft-box">'+esc(m.zone)+' <span class="muted">(contoh lokasi)</span></div></section></div>'+
    '<div class="col-md-5"><div class="section-label"><h2>Drop items</h2></div><ul class="drop-list mt-3">'+m.drops.map(function(x){return '<li><span>'+esc(x)+'</span><small class="muted">Demo</small></li>';}).join("")+'</ul>'+
    '<div class="soft-box mt-4"><strong>Perhatian:</strong> Seluruh atribut dan daftar drop pada halaman ini belum divalidasi. Belum ada informasi peluang drop yang dapat ditampilkan.</div></div></div>'+
    '<a class="btn btn-outline-rox mt-4" href="#/monsters">← Kembali ke database</a>';
  }
  function toolPage(){return crumb("Calculators")+top("TOOLS / 04","Stamina planner","Kalkulator demonstrasi untuk memperkirakan sisa stamina. Tidak menggunakan formula spesifik Ragnarok X.",true)+
    '<div class="panel"><div class="panel-body"><form id="staminaForm" class="row g-3" novalidate><div class="col-sm-6"><label class="form-label fw-semibold" for="currentStamina">Stamina awal</label><input class="form-control" id="currentStamina" type="number" min="0" max="999999" step="1" value="1000" required></div><div class="col-sm-6"><label class="form-label fw-semibold" for="spentStamina">Stamina digunakan</label><input class="form-control" id="spentStamina" type="number" min="0" max="999999" step="1" value="250" required></div><div class="col-12"><button type="submit" class="btn btn-rox">Hitung sisa stamina</button></div></form><div id="staminaResult" class="tool-output" role="status" aria-live="polite"><span class="result-label">ESTIMASI SISA</span><strong>750</strong><p>1000 − 250 = 750 stamina</p></div></div></div>'+
    '<p class="data-caption">* Perhitungan pengurangan sederhana. Tidak melibatkan regenerasi, cap, atau mekanik game.</p>';}
  function wireTool(){document.getElementById("staminaForm").addEventListener("submit",function(ev){ev.preventDefault();var a=Number(document.getElementById("currentStamina").value),b=Number(document.getElementById("spentStamina").value),out=document.getElementById("staminaResult");if(!Number.isSafeInteger(a)||!Number.isSafeInteger(b)||a<0||b<0||a>999999||b>999999){out.innerHTML='<span class="result-label">INPUT TIDAK VALID</span><p>Isi kedua angka dengan bilangan bulat 0–999999.</p>';return}var n=Math.max(0,a-b);out.innerHTML='<span class="result-label">ESTIMASI SISA</span><strong>'+fmt.format(n)+'</strong><p>'+fmt.format(a)+' − '+fmt.format(b)+' = '+fmt.format(a-b)+(b>a?' (dibatasi menjadi 0)':'')+'</p>';});}
  function reserve(id){
    var info={items:["ITEMS & CARDS","Item & cards","Daftar item, equipment, material, dan kartu akan ditambahkan setelah sumber data dan skema final diverifikasi."],jobs:["JOBS & SKILLS","Jobs & skills","Struktur job, skill, dan skill tree akan mengikuti kontrak data ROXPEDIA."],tracker:["TRACKER","MVP / Mini tracker","Rancangan tracker akan dibuat sesudah alur room, sinkronisasi, dan state dipastikan."],about:["ABOUT ROXPEDIA","Tentang proyek","ROXPEDIA adalah referensi komunitas Ragnarok X. Repositori ini adalah prototype independen untuk eksplorasi UI/UX, bukan produk production."]}[id];
    return crumb(info[1])+top(info[0],info[1],info[2],true)+'<div class="not-ready"><div class="soft-box"><strong>Status: belum diimplementasikan.</strong><p class="mb-0 mt-2">Halaman ini sengaja tidak diisi mockup data yang menyerupai informasi resmi. Langkah berikutnya adalah membuat model data dan komponen yang sesuai kebutuhan modul.</p></div><a class="btn btn-outline-rox back" href="#/">← Kembali ke beranda</a></div>';
  }
  function route(){
    var full=(location.hash||"#/").slice(1);
    var pathname=full.split("?")[0];
    var parts=pathname.split("/").filter(Boolean);
    var id=parts[0]||"home";
    if(id==="monsters"&&parts[1])appEl.innerHTML=detailPage(decodeURIComponent(parts[1]));
    else if(id==="monsters"){appEl.innerHTML=monstersPage();wireFilters();}
    else if(id==="home"){appEl.innerHTML=home();wireHomeSearch();}
    else if(id==="tools"){appEl.innerHTML=toolPage();wireTool();}
    else if(["items","jobs","tracker","about"].includes(id))appEl.innerHTML=reserve(id);
    else appEl.innerHTML=crumb("404")+top("NOT FOUND","Halaman tidak ditemukan","Silakan kembali ke direktori.",true)+'<a class="btn btn-outline-rox" href="#/">Ke beranda</a>';
    document.querySelectorAll("[data-route]").forEach(function(a){var active=a.getAttribute("data-route")===id;a.classList.toggle("active",active);if(active)a.setAttribute("aria-current","page");else a.removeAttribute("aria-current");});
    document.querySelectorAll(".side-nav a").forEach(function(a){var active=a.getAttribute("href")==="#/"+id;a.classList.toggle("active",active);if(active)a.setAttribute("aria-current","page");else a.removeAttribute("aria-current");});
    document.title=(id==="home"?"ROXPEDIA":id.charAt(0).toUpperCase()+id.slice(1)+" — ROXPEDIA")+" | UI Prototype";
    var collapse=document.getElementById("main-navigation");
    if(collapse&&collapse.classList.contains("show")&&window.bootstrap)window.bootstrap.Collapse.getOrCreateInstance(collapse,{toggle:false}).hide();
    window.scrollTo({top:0,behavior:"instant"});
  }
  function wireHomeSearch(){
    document.getElementById("siteSearchForm").addEventListener("submit",function(ev){
      ev.preventDefault();var q=document.getElementById("siteSearch").value.trim();
      location.hash="#/monsters"+(q?"?q="+encodeURIComponent(q):"");
    });
  }
  document.addEventListener("keydown",function(ev){if(ev.key!=="/"||ev.ctrlKey||ev.altKey||ev.metaKey)return;var t=ev.target;if(t&&(/^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName)||t.isContentEditable))return;var s=document.getElementById("siteSearch")||document.getElementById("filterSearch");if(s){ev.preventDefault();s.focus();}});
  window.addEventListener("hashchange",route);
  route();
})();
