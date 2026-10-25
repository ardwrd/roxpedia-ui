/* ROXPEDIA V5 — static design study informed by public and uploaded legacy pages.
   This is NOT connected to the CodeIgniter production API. */
"use strict";
(() => {
  const monsters = [
    {id:10001,name:"Poring",level:1,element:"Water",race:"Plant",size:"Medium",spawn:"Prontera South Gate",base:32,job:32},
    {id:10002,name:"Fabre",level:2,element:"Earth",race:"Insect",size:"Small",spawn:"Prontera South Gate",base:17,job:17},
    {id:10003,name:"Pupa",level:3,element:"Earth",race:"Insect",size:"Small",spawn:"Prontera South Gate",base:18,job:18},
    {id:10004,name:"Lunatic",level:4,element:"Neutral",race:"Brute",size:"Small",spawn:"Prontera South Gate",base:19,job:19},
    {id:10005,name:"Pecopeco Egg",level:5,element:"Neutral",race:"Formless",size:"Small",spawn:"Morroc",base:20,job:20},
    {id:10006,name:"Picky",level:6,element:"Fire",race:"Brute",size:"Small",spawn:"Morroc",base:21,job:21},
    {id:10007,name:"Drops",level:7,element:"Fire",race:"Plant",size:"Medium",spawn:"Morroc",base:33,job:55},
    {id:10008,name:"Condor",level:8,element:"Wind",race:"Brute",size:"Medium",spawn:"Prontera South Gate",base:46,job:46},
    {id:10009,name:"Picky (Shell)",level:9,element:"Fire",race:"Brute",size:"Small",spawn:"Morroc",base:24,job:24},
    {id:10010,name:"Willow",level:10,element:"Earth",race:"Plant",size:"Medium",spawn:"Payon South",base:50,job:50},
    {id:10011,name:"Rocker",level:11,element:"Earth",race:"Insect",size:"Medium",spawn:"Prontera West Gate",base:78,job:26},
    {id:10012,name:"Chonchon",level:12,element:"Wind",race:"Insect",size:"Small",spawn:"Morroc",base:41,job:14},
    {
      id:10108,name:"Argiope",level:52,element:"Earth",race:"Insect",size:"Large",spawn:"Mjolnir Mountains",base:237,job:237,hp:140030,zeny:108,
      description:"A strange insect with a hundred feet and strange protruding spikes on its head. Under normal conditions it does not attack without cause.",
      combat:[["P.DEF Level","284"],["Final P.DEF Increase","0.0%"],["M.DEF Level","284"],["Final M.DEF Increase","0.0%"],["Dodge Rate","0.0%"],["Dodge Level","57"],["Crit Resist Rate","0.0%"],["Crit Resist Level","57"]],
      skills:[["Poison Attribute Attack","Active · Max Lv 10 · Range 2"],["Argiope Normal Attack","Passive · Max Lv 1 · Range 2"],["Spell Target Detection","Type 3 · Max Lv 0 · Range 0"],["Change Target (Randomize Threat)","Type 3 · Max Lv 1 · Range 0"]],
      drops:["Argiope Card","Butterfly Wing Powder","Cracked Shell","Insect Feeler","Red Gemstone","Super Kart Figure","Tough Shell"]
    }
  ];
  const links=[
    ["Monster Database","Database Monster","Search monsters, EXP, drops and locations.","Cari monster, EXP, drop, dan lokasi.","#/monsters"],
    ["MVP / Mini Database","Database MVP / Mini","Boss records, locations and drop previews.","Informasi boss, lokasi, dan drop.","https://roxpedia.com/mvpmini-database"],
    ["Job Database","Database Job","Job progression and skills.","Progresi job dan skill.","https://roxpedia.com/job-database"],
    ["Trial Illusion Raids","Raid Trial Illusion","Raid stages, enemies and rewards.","Tahapan raid, musuh, dan reward.","https://roxpedia.com/raids"],
    ["Home System","Home System","Gardening, fishing, mining and more.","Gardening, fishing, mining, dan lainnya.","https://roxpedia.com/home-system"],
    ["MVP / Mini Trackers","Tracker MVP / Mini","Room-based boss timers and attempts.","Timer boss dan pencatatan attempt bersama party.","https://roxpedia.com/mvpminitrackers"],
    ["Refine Simulator","Refine Simulator","Refinement planning and materials.","Simulasi refine dan kebutuhan material.","https://roxpedia.com/refinesim"],
    ["Pet Simulator","Pet Simulator","Pet EXP, evolution and release.","EXP pet, evolusi, dan release.","https://roxpedia.com/petsimulator"],
    ["Dream Sand Conversion","Dream Sand Conversion","Tier and equipment conversion reference.","Konversi tier dan equipment.","https://roxpedia.com/dreamsandconversion"],
    ["Exchange Tax Calculator","Kalkulator Pajak Exchange","Calculate exchange taxes.","Hitung pajak exchange.","https://roxpedia.com/rareitemtaxcalc"],
    ["Fishing Rate","Fishing Rate","Fishing spots and efficiency.","Spot fishing dan efisiensi.","https://roxpedia.com/fishing"],
    ["Gardening Rate","Gardening Rate","Seed and garden reference.","Referensi seed dan gardening.","https://roxpedia.com/gardening"],
    ["Mining Rate","Mining Rate","Ores and mining drops.","Ore dan hasil mining.","https://roxpedia.com/mining"],
    ["Weapon Awakening","Weapon Awakening","Awakening power and progress.","Power dan progres awakening.","https://roxpedia.com/weapon-awakening"]
  ];
  const strings={
    en:{
      top:"Ragnarok X: Next Generation",community:"Community Reference",about:"About",docs:"API Docs",language:"Language",
      home:"Home",monsters:"Monsters",jobs:"Jobs",raids:"Raids",homeSystem:"Home System",toolsNav:"Tools & calculators",
      searchPlaceholder:"Search monsters...",search:"Search",liveWebsite:"Live website",darkMode:"Dark mode",lightMode:"Light mode",
      preview:"Redesign preview",notice:"Historical ROXPEDIA data samples are used for layout review. Gameplay data and EXP formulas remain authoritative on",
      homeDescription:"An independent Ragnarok X database and toolkit. Game information, not another dashboard.",
      explore:"Explore the database",databases:"Databases & references",utilities:"Tools & simulators",
      featured:"Monster database",featuredText:"Look up monster levels, properties, EXP values, spawn locations and related details.",
      openDatabase:"Browse Monster Database",records:"Sample monster records",updates:"Reference notes",patch:"SEA patch baseline",
      patchDescription:"Source site currently references the November 24, 2025 SEA patch.",
      complete:"See live website for full information",breadcrumbHome:"Home",browse:"Browse",showing:"Showing",of:"of",entries:"records",
      monsterTitle:"Monster Database",monsterSubtitle:"Compare monsters by level, size, race, element and EXP. Open any row to inspect its details.",
      filters:"Filters",monsterSearch:"Monster name",size:"Size",raceElement:"Race / Property",allSizes:"All sizes",
      allRaces:"All races & properties",reset:"Reset filters",sort:"Sort by",sortLevel:"Level: low to high",
      sortLevelDesc:"Level: high to low",sortName:"Name: A to Z",results:"Monster Results",
      monster:"Monster",level:"Level",race:"Race",element:"Element",location:"Location",baseExp:"Base EXP",jobExp:"Job EXP",
      noResults:"No monsters match these filters.",prev:"Previous",next:"Next",page:"Page",details:"Details",
      expCalculator:"EXP Calculator",expSubtitle:"Reference controls from the legacy calculator",characterLevel:"Your level",
      partySize:"Party size",classes:"Unique classes",worldLevel:"World level",odin:"Use 5× EXP (Odin)",exact:"Base EXP > 50%",
      calcUnavailable:"Live calculation is not connected in this preview. No results are estimated.",
      recommended:"Best Matches",recommendedHint:"Select your level to see nearby sample monsters. These are proximity suggestions, not calculated EXP recommendations.",
      noNearby:"No nearby sample records in this subset.",allMonsters:"All monsters",
      summary:"Monster Information",combat:"Combat Attributes",spawn:"Spawn Location",skills:"Monster Skills",drops:"Monster Drop List",
      related:"Monsters in the same level range",notAvailable:"Not available in this sample",notVerified:"Unverified",
      missingStats:"Additional combat attributes are not included in this sample.",dropNote:"Drop rates should be loaded from the live database.",
      detailNote:"Only Argiope has an extended verified snapshot in this prototype. Other monster pages intentionally show limited information.",
      unavailable:"This record is not included in the prototype.",back:"Back to monsters",
      toolsTitle:"Tools & Calculators",toolsSubtitle:"Open the existing ROXPEDIA calculators while their replacement interfaces are being designed.",
      openLive:"Open live feature",newTab:"opens the live website in a new tab",copyright:"Independent database and reference for Ragnarok X: Next Generation.",
      languageOption:"English",levelAbbr:"Lv",
      item:"Item",category:"Category",noDrop:"Drop data unavailable in sample."
    },
    id:{
      top:"Ragnarok X: Next Generation",community:"Referensi Komunitas",about:"Tentang",docs:"Dokumentasi API",language:"Bahasa",
      home:"Beranda",monsters:"Monster",jobs:"Job",raids:"Raid",homeSystem:"Home System",toolsNav:"Tools & kalkulator",
      searchPlaceholder:"Cari monster...",search:"Cari",liveWebsite:"Website aktif",darkMode:"Mode gelap",lightMode:"Mode terang",
      preview:"Pratinjau redesign",notice:"Sampel data ROXPEDIA digunakan untuk meninjau desain. Data game dan rumus EXP resmi tetap mengacu pada",
      homeDescription:"Database dan tools independen untuk Ragnarok X. Informasi game tanpa dashboard yang tidak diperlukan.",
      explore:"Jelajahi database",databases:"Database & referensi",utilities:"Tools & simulator",
      featured:"Database monster",featuredText:"Cari level, elemen, EXP, lokasi spawn, dan detail monster.",
      openDatabase:"Buka Database Monster",records:"Contoh data monster",updates:"Catatan referensi",patch:"Acuan patch SEA",
      patchDescription:"Website sumber saat ini merujuk pada patch SEA 24 November 2025.",
      complete:"Lihat website aktif untuk informasi lengkap",breadcrumbHome:"Beranda",browse:"Jelajahi",showing:"Menampilkan",of:"dari",entries:"data",
      monsterTitle:"Database Monster",monsterSubtitle:"Bandingkan monster berdasarkan level, ukuran, ras, elemen, dan EXP. Buka detail untuk informasi lengkap.",
      filters:"Filter",monsterSearch:"Nama monster",size:"Ukuran",raceElement:"Ras / Elemen",allSizes:"Semua ukuran",
      allRaces:"Semua ras & elemen",reset:"Reset filter",sort:"Urutkan",sortLevel:"Level: terendah",
      sortLevelDesc:"Level: tertinggi",sortName:"Nama: A–Z",results:"Hasil Monster",
      monster:"Monster",level:"Level",race:"Ras",element:"Elemen",location:"Lokasi",baseExp:"Base EXP",jobExp:"Job EXP",
      noResults:"Tidak ada monster sesuai filter.",prev:"Sebelumnya",next:"Berikutnya",page:"Halaman",details:"Detail",
      expCalculator:"Kalkulator EXP",expSubtitle:"Kontrol referensi dari kalkulator lama",characterLevel:"Level karakter",
      partySize:"Jumlah party",classes:"Jumlah class unik",worldLevel:"World level",odin:"Gunakan EXP 5× (Odin)",exact:"Base EXP > 50%",
      calcUnavailable:"Perhitungan live belum terhubung dalam prototype. Tidak ada hasil yang direkayasa.",
      recommended:"Rekomendasi Terdekat",recommendedHint:"Pilih level untuk melihat sampel monster dengan level terdekat. Ini bukan rekomendasi perhitungan EXP.",
      noNearby:"Belum ada sampel monster dengan level terdekat.",allMonsters:"Semua monster",
      summary:"Informasi Monster",combat:"Atribut Combat",spawn:"Lokasi Spawn",skills:"Skill Monster",drops:"Daftar Drop Monster",
      related:"Monster dengan rentang level serupa",notAvailable:"Tidak tersedia pada sampel",notVerified:"Belum terverifikasi",
      missingStats:"Atribut combat tambahan belum tersedia pada sampel ini.",dropNote:"Drop rate perlu diambil dari database live.",
      detailNote:"Hanya Argiope yang memiliki snapshot detail terverifikasi pada prototype ini. Monster lain ditampilkan secara terbatas.",
      unavailable:"Data tersebut belum disertakan pada prototype.",back:"Kembali ke daftar monster",
      toolsTitle:"Tools & Kalkulator",toolsSubtitle:"Gunakan kalkulator ROXPEDIA yang aktif selagi tampilan penggantinya dirancang.",
      openLive:"Buka fitur aktif",newTab:"membuka website aktif di tab baru",copyright:"Database dan referensi independen untuk Ragnarok X: Next Generation.",
      languageOption:"Indonesia",levelAbbr:"Lv",
      item:"Item",category:"Kategori",noDrop:"Data drop tidak tersedia pada sampel."
    }
  };
  const $ = s => document.querySelector(s);
  const app = $("#app");
  const escape = v => String(v??"").replace(/[&<>"']/g, x => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[x]));
  const getStored = (key, fallback) => { try {return localStorage.getItem(key)||fallback} catch {return fallback} };
  const setStored = (key,val) => {try {localStorage.setItem(key,val)} catch {} };
  const urlLang=new URLSearchParams(location.search).get("lang");
  let language = ["id","en"].includes(urlLang)?urlLang:getStored("rox_ui_language","en");
  if(!strings[language])language="en";
  let state = {q:"",size:"",rp:"",sort:"level",page:1,level:52};
  const t = key => strings[language][key] || strings.en[key] || key;
  const number = n => n==null?"—":Number(n).toLocaleString(language==="id"?"id-ID":"en-US");
  const externalAttrs = 'target="_blank" rel="noopener noreferrer"';
  const sprite = (m,big=false) => '<span class="'+(big?"detail-sprite":"sprite")+'" data-sprite><img loading="lazy" src="https://roxpedia.com/assets/img/monster/'+m.id+'.png" alt="'+escape(m.name)+'" onerror="this.parentElement.classList.add(\'fallback\');this.parentElement.textContent=\'No image\'"></span>';
  const crumb = parts => '<div class="breadcrumbs"><a href="#/">'+t("breadcrumbHome")+'</a>'+parts.map(p=>'<span>/</span>'+escape(p)).join("")+'</div>';
  const title = (name,desc) => '<div class="page-heading"><h1>'+escape(name)+'</h1><p>'+escape(desc)+'</p></div>';
  const head = (name,extra="") => '<div class="block-heading"><h2>'+escape(name)+'</h2>'+extra+'</div>';
  const siteLink = (href,text,css="resource-row") => '<a class="'+css+'" href="'+href+'" '+(href.startsWith("http")?externalAttrs:"")+'>'+escape(text)+'</a>';
  const langName = (l,i) => escape(language==="id"?l[1]:l[0]);
  const hrefFor = l => l[4].startsWith("http") ? l[4]+"?lang="+language : l[4];
  const resource = l => '<a class="resource-row" href="'+hrefFor(l)+'" '+(l[4].startsWith("http")?externalAttrs:"")+'>'
      +'<span><span class="resource-name">'+langName(l)+'</span><span class="resource-description">'+escape(language==="id"?l[3]:l[2])+'</span></span><span class="resource-indicator" aria-hidden="true">↗</span></a>';
  function home() {
    return '<div class="content-root"><div class="home-heading"><div><div class="eyebrow">'+t("explore")+'</div><h1>ROXPEDIA</h1><p>'+t("homeDescription")+'</p></div>'
      +'<div class="patch-note"><strong>'+t("patch")+'</strong>'+t("patchDescription")+'</div></div>'
      +'<div class="home-columns"><section>'+head(t("databases"))+links.slice(0,6).map(resource).join("")+'</section>'
      +'<section>'+head(t("utilities"))+links.slice(6).map(resource).join("")+'</section></div>'
      +'<div class="home-bottom"><section>'+head(t("featured"),'<a href="#/monsters">'+t("openDatabase")+' →</a>')+
      '<div class="quick-info"><p>'+t("featuredText")+'</p><div class="result-panel">'+renderMonsterTable(monsters.slice(0,5))+'</div>'
      +'<a class="action-link" href="#/monsters">'+t("openDatabase")+' →</a></div></section>'
      +'<aside>'+head(t("updates"))+'<div class="activity-row"><span>'+t("patch")+'</span><span>24 Nov 2025</span></div>'
      +'<div class="activity-row"><span>ROXPEDIA / redesign preview</span><span>V5</span></div><p class="data-caveat">'+t("complete")+'</p></aside></div></div>';
  }
  function row(m) {
    return '<tr><td><div class="monster-cell">'+sprite(m)+'<span><a class="name" href="#/monsters/'+m.id+'">'+escape(m.name)+'</a><div class="number">#'+m.id+'</div></span></div></td>'
    +'<td class="level">'+m.level+'</td><td><span class="attribute attr-'+m.element.toLowerCase()+'">'+escape(m.element)+'</span></td><td>'+escape(m.race)+'</td>'
    +'<td>'+escape(m.size)+'</td><td class="monster-location">'+escape(m.spawn)+'</td><td class="num">'+number(m.base)+'</td><td class="num">'+number(m.job)+'</td>'
    +'<td><a class="table-go" href="#/monsters/'+m.id+'">'+t("details")+' →</a></td></tr>';
  }
  function mobileRow(m) {
    return '<a class="mobile-monster" href="#/monsters/'+m.id+'">'+sprite(m)+'<span class="flex-grow-1"><strong>'+escape(m.name)+'</strong>'
    +'<small>'+t("levelAbbr")+' '+m.level+' · '+escape(m.element)+' · '+escape(m.size)+'</small>'
    +'<small>'+t("baseExp")+' '+number(m.base)+' / '+t("jobExp")+' '+number(m.job)+'</small></span><span class="mobile-arrow">→</span></a>';
  }
  function renderMonsterTable(arr) {
    if (!arr.length) return '<div class="empty">'+t("noResults")+'</div>';
    return '<div class="table-responsive"><table class="table monster-table"><thead><tr>'
      +[t("monster"),t("level"),t("element"),t("race"),t("size"),t("location"),t("baseExp"),t("jobExp"),""].map(x=>'<th>'+escape(x)+'</th>').join("")+'</tr></thead>'
      +'<tbody>'+arr.map(row).join("")+'</tbody></table></div><div class="mobile-monsters">'+arr.map(mobileRow).join("")+'</div>';
  }
  const racePropertyOptions = [...new Set(monsters.flatMap(m=>["Race: "+m.race,"Property: "+m.element]))].sort();
  function selectOpts(arr, chosen) {return arr.map(x=>'<option value="'+escape(x[0])+'"'+(x[0]===chosen?' selected':'')+'>'+escape(x[1])+'</option>').join("")}
  function listing() {
    return '<div class="content-root">'+crumb([t("monsters")])+title(t("monsterTitle"),t("monsterSubtitle"))
    +'<div class="row g-4"><aside class="col-12 col-lg-3"><form id="filterForm" class="sidebar-block">'
      +'<h2>'+t("filters")+'</h2><div class="mb-3"><label class="form-label" for="monsterName">'+t("monsterSearch")+'</label><input id="monsterName" type="search" class="form-control" autocomplete="off" value="'+escape(state.q)+'" placeholder="'+t("searchPlaceholder")+'"></div>'
      +'<div class="mb-3"><label class="form-label" for="monsterSize">'+t("size")+'</label><select id="monsterSize" class="form-select">'
      +selectOpts([["",t("allSizes")],...["Small","Medium","Large"].map(x=>[x,x])],state.size)+'</select></div>'
      +'<div class="mb-3"><label class="form-label" for="monsterRace">'+t("raceElement")+'</label><select id="monsterRace" class="form-select">'
      +selectOpts([["",t("allRaces")],...racePropertyOptions.map(x=>[x,x])],state.rp)+'</select></div>'
      +'<button id="filterReset" class="flat-btn w-100" type="button">'+t("reset")+'</button></form>'
      +'<section class="calculator-mini"><h2>'+t("expCalculator")+'</h2><p>'+t("expSubtitle")+'</p>'
      +'<div class="row g-2"><div class="col-6"><label class="form-label small" for="charLevel">'+t("characterLevel")+'</label><input id="charLevel" class="form-control form-control-sm" type="number" min="1" max="160" value="'+state.level+'"></div>'
      +'<div class="col-6"><label class="form-label small" for="partySize">'+t("partySize")+'</label><select id="partySize" class="form-select form-select-sm">'+selectOpts([["1","1"],["2","2"],["3","3"],["4","4"],["5","5"],["2c","2 + Couple"],["3c","3 + Couple"]],"1")+'</select></div>'
      +'<div class="col-6"><label class="form-label small" for="uniqueClasses">'+t("classes")+'</label><select id="uniqueClasses" class="form-select form-select-sm">'+selectOpts(["1","2","3","4","5"].map(x=>[x,x]),"1")+'</select></div>'
      +'<div class="col-6"><label class="form-label small" for="worldLevel">'+t("worldLevel")+'</label><input id="worldLevel" class="form-control form-control-sm" type="number" min="1" max="200" value="150"></div></div>'
      +'<div class="form-check mt-3"><input id="odin" type="checkbox" class="form-check-input"><label class="form-check-label small" for="odin">'+t("odin")+'</label></div>'
      +'<div class="form-check mt-1"><input id="exp50" type="checkbox" class="form-check-input"><label class="form-check-label small" for="exp50">'+t("exact")+'</label></div>'
      +'<p class="data-caveat">'+t("calcUnavailable")+'</p><hr>'
      +'<h2>'+t("recommended")+'</h2><p>'+t("recommendedHint")+'</p><div id="nearby"></div></section></aside>'
      +'<div class="col-12 col-lg-9"><div class="page-actions"><span class="page-stamp">'+t("records")+' · '+monsters.length+'</span>'
      +'<a href="https://roxpedia.com/monsters?lang='+language+'" '+externalAttrs+' class="action-link m-0">'+t("complete")+' ↗</a></div>'
      +'<section class="result-panel"><div class="result-toolbar"><div><h2>'+t("results")+'</h2><span class="result-meta" id="count" aria-live="polite"></span></div>'
      +'<div class="d-flex align-items-center gap-2"><label class="visually-hidden" for="sort">'+t("sort")+'</label><select id="sort" class="form-select form-select-sm">'
      +selectOpts([["level",t("sortLevel")],["level-desc",t("sortLevelDesc")],["name",t("sortName")]],state.sort)+'</select></div></div>'
      +'<div id="results"></div><div class="pagination-strip"><span id="paginationInfo"></span><div class="pager-buttons"><button id="prev" type="button">'+t("prev")+'</button><span id="pageLabel"></span><button id="next" type="button">'+t("next")+'</button></div></div></section></div></div></div>';
  }
  function filtered(){
    const query=state.q.trim().toLowerCase();
    return monsters.filter(m=>{
      const hay=(m.name+" "+m.spawn+" "+m.race+" "+m.element).toLowerCase();
      return (!query||hay.includes(query))&&(!state.size||m.size===state.size)&&(!state.rp||(state.rp.startsWith("Race: ")?m.race===state.rp.slice(6):m.element===state.rp.slice(10)));
    }).sort((a,b)=>state.sort==="name"?a.name.localeCompare(b.name):state.sort==="level-desc"?b.level-a.level:a.level-b.level);
  }
  function refreshList() {
    const arr=filtered(),perPage=9,total=Math.max(1,Math.ceil(arr.length/perPage));
    state.page=Math.max(1,Math.min(state.page,total));
    const shown=arr.slice((state.page-1)*perPage,state.page*perPage);
    $("#results").innerHTML=renderMonsterTable(shown);
    $("#count").textContent=" · "+arr.length+" "+t("entries");
    $("#paginationInfo").textContent=arr.length?t("showing")+" "+((state.page-1)*perPage+1)+"–"+Math.min(arr.length,state.page*perPage)+" "+t("of")+" "+arr.length:t("noResults");
    $("#pageLabel").textContent=t("page")+" "+state.page+" / "+total;
    $("#prev").disabled=state.page<=1;$("#next").disabled=state.page>=total;
  }
  function refreshNearby() {
    const current=Math.min(160,Math.max(1,Number(state.level)||1));
    const candidates=monsters.filter(m=>Math.abs(m.level-current)<=10).sort((a,b)=>Math.abs(a.level-current)-Math.abs(b.level-current)).slice(0,4);
    $("#nearby").innerHTML=candidates.length?'<ul class="nearby-results">'+candidates.map(m=>'<li><a href="#/monsters/'+m.id+'">'+escape(m.name)+'</a><em>'+t("levelAbbr")+' '+m.level+'</em></li>').join("")+'</ul>':'<p class="nearby-empty">'+t("noNearby")+'</p>';
  }
  function bindListing(){
    const bind=(id,key,event)=>$(id).addEventListener(event,e=>{state[key]=e.target.value;state.page=1;refreshList()});
    bind("#monsterName","q","input");bind("#monsterSize","size","change");bind("#monsterRace","rp","change");bind("#sort","sort","change");
    $("#filterForm").addEventListener("submit",e=>e.preventDefault());
    $("#filterReset").addEventListener("click",()=>{state.q="";state.size="";state.rp="";state.page=1;$("#monsterName").value="";$("#monsterSize").value="";$("#monsterRace").value="";refreshList();});
    $("#prev").addEventListener("click",()=>{state.page--;refreshList()});
    $("#next").addEventListener("click",()=>{state.page++;refreshList()});
    $("#charLevel").addEventListener("input",e=>{state.level=e.target.value;refreshNearby()});
    refreshList();refreshNearby();
  }
  function section(name,inner) {return '<section class="detail-section"><h2>'+escape(name)+'</h2>'+inner+'</section>';}
  function factTable(rows) {return '<table class="fact-table"><tbody>'+rows.map(([key,value])=>'<tr><th scope="row">'+escape(key)+'</th><td>'+escape(value)+'</td></tr>').join("")+'</tbody></table>';}
  function detail(id) {
    const m=monsters.find(m=>String(m.id)===String(id));
    if(!m)return '<div class="content-root">'+crumb([t("monsters")])+title(t("unavailable"),t("complete"))+'<a href="#/monsters">'+t("back")+'</a></div>';
    const summary=[[t("level"),m.level],["Max HP",number(m.hp)],[t("baseExp"),number(m.base)],[t("jobExp"),number(m.job)],["Zeny",number(m.zeny)]];
    const related=monsters.filter(x=>x.id!==m.id).sort((a,b)=>Math.abs(a.level-m.level)-Math.abs(b.level-m.level)).slice(0,6);
    const stats=m.combat?factTable([["Max HP",number(m.hp)],...m.combat]):'<div class="panel-note">'+t("missingStats")+'</div>';
    const skillContent=m.skills?m.skills.map(x=>'<div class="detail-row"><strong>'+escape(x[0])+'</strong><small>'+escape(x[1])+'</small></div>').join(""):'<p class="panel-note">'+t("notAvailable")+'</p>';
    const dropContent=m.drops?m.drops.map((name,i)=>'<div class="detail-row"><strong>'+escape(name)+'</strong><small>'+(i===0?"Card":"Material")+' · '+t("dropNote")+'</small></div>').join(""):'<p class="panel-note">'+t("noDrop")+'</p>';
    const relatedHTML='<div class="related-list">'+related.map(x=>'<a href="#/monsters/'+x.id+'">'+escape(x.name)+'<small>'+t("levelAbbr")+' '+x.level+'</small></a>').join("")+'</div>';
    return '<div class="content-root">'+crumb([t("monsters"),m.name])+'<a href="#/monsters" class="detail-back">← '+t("back")+'</a>'
      +'<div class="detail-hero">'+sprite(m,true)+'<div><div class="eyebrow">'+t("summary")+'</div><h1>'+escape(m.name)+'</h1>'
      +'<div class="detail-meta"><span>'+t("levelAbbr")+' '+m.level+'</span><span>'+escape(m.element)+'</span><span>'+escape(m.race)+'</span><span>'+escape(m.size)+'</span></div>'
      +'<p>'+(m.description?escape(m.description):t("detailNote"))+'</p></div></div>'
      +'<div class="statline">'+summary.map(([key,value])=>'<div class="stat-cell"><small>'+escape(key)+'</small><strong>'+escape(value)+'</strong></div>').join("")+'</div>'
      +'<div class="detail-columns"><div>'+section(t("combat"),stats)
      +section(t("spawn"),'<div class="location-line"><div class="location-symbol" aria-hidden="true">⌖</div><strong>'+escape(m.spawn)+'</strong></div>')
      +section(t("skills"),skillContent)+'</div><div>'+section(t("drops"),dropContent)+section(t("related"),relatedHTML)
      +'<p class="data-caveat">'+t("detailNote")+'</p><a href="https://roxpedia.com/monsters/detail/'+m.id+'?lang='+language+'" '+externalAttrs+' class="action-link">'+t("complete")+' ↗</a></div></div></div>';
  }
  function toolsPage(){
    return '<div class="content-root">'+crumb([t("toolsNav")])+title(t("toolsTitle"),t("toolsSubtitle"))
      +'<div class="tools-grid">'+links.slice(6).map(resource).join("")+'</div></div>';
  }
  function activePage(){return ((location.hash||"#/").slice(2).split("?")[0].split("/")[0]||"home");}
  function render(){
    const route=activePage();
    if(route==="home")app.innerHTML=home();
    else if(route==="monsters"){
      const sub=(location.hash||"").split("?")[0].split("/")[2];
      if(sub)app.innerHTML=detail(decodeURIComponent(sub));
      else {
        const q=new URLSearchParams((location.hash||"").split("?")[1]||"").get("q");
        if(q!==null){state.q=q;state.page=1}
        app.innerHTML=listing();bindListing();
      }
    } else app.innerHTML=toolsPage();
    document.querySelectorAll("[data-page]").forEach(el=>{
      const active=el.dataset.page===route;el.classList.toggle("active",active);
      if(active)el.setAttribute("aria-current","page");else el.removeAttribute("aria-current");
    });
    document.title=(route==="home"?"ROXPEDIA":route==="monsters"?t("monsterTitle"):t("toolsTitle"))+" — Ragnarok X";
    const menu=$("#navMenu");
    if(menu&&menu.classList.contains("show")&&window.bootstrap)window.bootstrap.Collapse.getOrCreateInstance(menu,{toggle:false}).hide();
  }
  function syncI18n(){
    document.documentElement.lang=language==="id"?"id":"en";
    document.querySelectorAll("[data-i18n]").forEach(n=>n.textContent=t(n.dataset.i18n));
    $("#globalQuery").placeholder=t("searchPlaceholder");
    $("#globalQuery").setAttribute("aria-label",t("searchPlaceholder"));
    $("#themeToggle").textContent=t(document.documentElement.getAttribute("data-bs-theme")==="dark"?"lightMode":"darkMode");
    $("#themeToggle").setAttribute("aria-label",$("#themeToggle").textContent);
    const selector=$("#languageSelect");if(selector)selector.value=language;
    document.querySelectorAll("[data-site-lang-link]").forEach(a=>{a.href=a.dataset.originalUrl+"?lang="+language});
    render();
  }
  function switchLanguage(next){
    if(!strings[next])return;
    language=next;setStored("rox_ui_language",next);
    const url=new URL(location.href);url.searchParams.set("lang",language);
    history.replaceState(null,"",url.pathname+url.search+url.hash);
    syncI18n();
  }
  const savedTheme=getStored("rox_ui_theme","light");
  document.documentElement.setAttribute("data-bs-theme",savedTheme==="dark"?"dark":"light");
  const logo=$("#brandLogo");
  logo.addEventListener("error",()=>{logo.hidden=true;logo.nextElementSibling.style.display="inline"});
  logo.addEventListener("load",()=>{logo.hidden=false;logo.nextElementSibling.style.display="none"});
  $("#themeToggle").addEventListener("click",()=>{
    const next=document.documentElement.getAttribute("data-bs-theme")==="dark"?"light":"dark";
    document.documentElement.setAttribute("data-bs-theme",next);setStored("rox_ui_theme",next);syncI18n();
  });
  $("#languageSelect").addEventListener("change",e=>switchLanguage(e.target.value));
  $("#headerSearch").addEventListener("submit",e=>{
    e.preventDefault();const q=$("#globalQuery").value.trim();
    state.q=q;state.size="";state.rp="";state.page=1;
    const target="#/monsters"+(q?"?q="+encodeURIComponent(q):"");
    if(location.hash===target)render();else location.hash=target;
  });
  document.addEventListener("keydown",e=>{
    if(e.key!=="/"||e.ctrlKey||e.altKey||e.metaKey)return;
    const tg=e.target;
    if(tg&&(["INPUT","TEXTAREA","SELECT"].includes(tg.tagName)||tg.isContentEditable))return;
    e.preventDefault();$("#globalQuery").focus();
  });
  window.addEventListener("hashchange",()=>{render();window.scrollTo(0,0)});
  syncI18n();
})();