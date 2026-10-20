/* ROXPEDIA / legacy-led interface study 04. All displayed records are UI fixtures. */
"use strict";
(function() {
  const records = [
    {id:"poring",name:"Poring",lvl:1,property:"Water",size:"Medium",race:"Plant",location:"Prontera South Gate",drops:["Jellopy","Sticky Mucus","Poring Card"]},
    {id:"lunatic",name:"Lunatic",lvl:3,property:"Neutral",size:"Small",race:"Brute",location:"Prontera South Gate",drops:["Feather","Lunatic Card"]},
    {id:"fabre",name:"Fabre",lvl:5,property:"Earth",size:"Small",race:"Insect",location:"Prontera West Gate",drops:["Fluff","Green Herb","Fabre Card"]},
    {id:"rocker",name:"Rocker",lvl:8,property:"Earth",size:"Medium",race:"Insect",location:"Prontera West Gate",drops:["Grasshopper Leg","Rocker Card"]},
    {id:"marine",name:"Marin",lvl:16,property:"Water",size:"Medium",race:"Plant",location:"Payon Forest",drops:["Sticky Mucus","Marin Card"]},
    {id:"wolf",name:"Wolf",lvl:24,property:"Earth",size:"Medium",race:"Brute",location:"Payon Forest",drops:["Wolf Claw","Animal Skin","Wolf Card"]},
    {id:"isis",name:"Isis",lvl:47,property:"Shadow",size:"Large",race:"Demon",location:"Pyramid",drops:["Scale Skin","Isis Card"]},
    {id:"argiope",name:"Argiope",lvl:62,property:"Poison",size:"Large",race:"Insect",location:"Mjolnir Mountains",drops:["Cobweb","Poison Spore","Argiope Card"]}
  ];
  const categories=[
    ["Monsters","Search monster stats, EXP, drops and spawn locations","monsters"],
    ["MVP / Mini","Boss database and drops","bosses"],
    ["Items & Cards","Items, cards, crafting and drop sources","items"],
    ["Jobs & Skills","Job progression and skills","jobs"],
    ["Raids","Stage, difficulty and reward references","raids"],
    ["Tools","Refine, pet and other calculators","tools"],
    ["MVP / Mini Tracker","Party rooms, timers and attempts","tracker"]
  ];
  let listState={q:"",size:"",rp:"",sort:"level",page:1};
  const app=document.getElementById("app");
  const escapeHTML=v=>String(v??"").replace(/[&<>"']/g,x=>({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[x]));
  function crumb(parts){return '<div class="crumb"><a href="#/">Home</a>'+parts.map(p=>'<span class="sep">/</span>'+escapeHTML(p)).join("")+'</div>';}
  function heading(title,description){return '<div class="page-intro"><h1 class="page-title">'+escapeHTML(title)+'</h1><p class="page-subtitle">'+escapeHTML(description)+'</p></div>';}
  function section(name,link,url){return '<div class="section-head"><h2>'+escapeHTML(name)+'</h2>'+(link?'<a href="'+url+'">'+escapeHTML(link)+' →</a>':'')+'</div>';}
  function item(m){return '<tr><td><div class="d-flex align-items-center gap-2"><span class="row-icon" aria-label="Artwork unavailable">No art</span><a class="monster-name" href="#/monsters/'+encodeURIComponent(m.id)+'">'+escapeHTML(m.name)+'</a></div></td><td>'+m.lvl+'</td><td>'+escapeHTML(m.size)+'</td><td>'+escapeHTML(m.race)+'</td><td>'+escapeHTML(m.property)+'</td><td>'+escapeHTML(m.location)+'</td><td><a href="#/monsters/'+encodeURIComponent(m.id)+'">Details</a></td></tr>';}
  function mobileItem(m){return '<a class="mobile-row" href="#/monsters/'+encodeURIComponent(m.id)+'"><span class="row-icon" aria-hidden="true">No art</span><span><strong>'+escapeHTML(m.name)+'</strong><small>Lv. '+m.lvl+' · '+escapeHTML(m.property)+' · '+escapeHTML(m.size)+'</small></span><span aria-hidden="true">→</span></a>';}
  function recordList(rows){if(!rows.length)return '<div class="empty-result">No monsters match the current filters.</div>';return '<div class="d-none d-md-block table-responsive"><table class="table table-rox align-middle"><thead><tr><th>Monster</th><th>Level</th><th>Size</th><th>Race</th><th>Property</th><th>Location</th><th></th></tr></thead><tbody>'+rows.map(item).join("")+'</tbody></table></div><div class="d-md-none">'+rows.map(mobileItem).join("")+'</div>';}
  function home(){return '<div class="home-intro"><h1>ROXPEDIA</h1><p>Game database and tools for Ragnarok X. Find monsters, item sources, jobs and the calculations you use while playing.</p></div>'+
    section("Databases & tools","","")+'<div class="row g-0"><div class="col-md-6 pe-md-3"><div class="directory-list">'+categories.slice(0,4).map(c=>'<a class="directory-item" href="#/'+c[2]+'"><span><strong>'+escapeHTML(c[0])+'</strong><small>'+escapeHTML(c[1])+'</small></span><span class="arrow" aria-hidden="true">→</span></a>').join("")+'</div></div><div class="col-md-6 ps-md-3"><div class="directory-list">'+categories.slice(4).map(c=>'<a class="directory-item" href="#/'+c[2]+'"><span><strong>'+escapeHTML(c[0])+'</strong><small>'+escapeHTML(c[1])+'</small></span><span class="arrow" aria-hidden="true">→</span></a>').join("")+'</div></div></div>'+
    section("Monster database","Browse all monsters","#/monsters")+'<div class="panel">'+recordList(records.slice(0,5))+'</div><p class="text-secondary small mt-2">Sample records for layout review; gameplay fields are not authoritative.</p>';}
  function filters(){
    return '<div class="filter-panel"><form id="filters" class="row g-3 align-items-end" role="search">'+
    '<div class="col-12 col-md-4"><label for="monsterSearch">Search monster</label><input id="monsterSearch" class="form-control" placeholder="Name or location" type="search" autocomplete="off" value="'+escapeHTML(listState.q)+'"></div>'+
    '<div class="col-6 col-md-2"><label for="size">Size</label><select id="size" class="form-select"><option value="">All sizes</option>'+["Small","Medium","Large"].map(x=>'<option value="'+x+'"'+(listState.size===x?' selected':'')+'>'+x+'</option>').join("")+'</select></div>'+
    '<div class="col-6 col-md-3"><label for="raceProperty">Race / property</label><select id="raceProperty" class="form-select"><option value="">All races / properties</option>'+[...new Set(records.flatMap(m=>["Race: "+m.race,"Property: "+m.property]))].sort().map(x=>'<option value="'+escapeHTML(x)+'"'+(listState.rp===x?' selected':'')+'>'+escapeHTML(x)+'</option>').join("")+'</select></div>'+
    '<div class="col-8 col-md-2"><label for="order">Sort</label><select id="order" class="form-select"><option value="level">Level ↑</option><option value="level-desc">Level ↓</option><option value="name">Name A–Z</option></select></div>'+
    '<div class="col-4 col-md-1"><button class="btn btn-outline-primary w-100" type="button" id="resetFilter" aria-label="Reset filters">Reset</button></div></form></div>';
  }
  function expCalculator(){
    return '<details class="exp-block"><summary>EXP Calculator & recommendations <span class="text-secondary fw-normal">(legacy feature layout)</span></summary><div class="exp-body">'+
      '<div class="row g-3">'+
      '<div class="col-6 col-md-3 exp-field"><label for="charLevel">Your level</label><input id="charLevel" class="form-control" type="number" min="1" max="160" value="50"></div>'+
      '<div class="col-6 col-md-3 exp-field"><label for="partySize">Party size</label><select id="partySize" class="form-select"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option value="2c">2 + Couple</option><option value="3c">3 + Couple</option></select></div>'+
      '<div class="col-6 col-md-3 exp-field"><label for="worldLevel">World level</label><input id="worldLevel" class="form-control" type="number" min="1" max="200" value="150"></div>'+
      '<div class="col-6 col-md-3 exp-field"><label for="uniqueClasses">Unique classes</label><input id="uniqueClasses" class="form-control" type="number" min="1" max="5" value="1"></div>'+
      '<div class="col-12 d-flex gap-4 flex-wrap"><label class="form-check-label"><input id="useOdin" class="form-check-input me-1" type="checkbox"> Use Odin</label><label class="form-check-label"><input id="exactAbove50" class="form-check-input me-1" type="checkbox"> Exact level difference above 50</label></div></div>'+
      '<div class="exp-output mt-3" role="note"><strong>Calculation unavailable in this static preview.</strong> The old UI uses backend-derived EXP logic and recommendation data. No estimated numbers are invented here.</div></div></details>';
  }
  function listing(){
    return crumb(["Monsters"])+heading("Monster Database","Find monsters by name, size, race, property and location.")+
    filters()+expCalculator()+'<div class="list-head"><h2 class="h6 fw-bold m-0">Monster Results</h2><span class="list-count" id="listCount" role="status"></span></div>'+
    '<div class="panel" id="monsterRows"></div><div class="pager" id="pager"></div>'+
    '<p class="small text-secondary mt-1">Demo list for UI review. Monster level, element, drops and location are not verified game data.</p>';
  }
  function applyFilters(){
    let rows=records.filter(m=>{
      const q=listState.q.trim().toLowerCase(),all=(m.name+" "+m.location+" "+m.race+" "+m.property).toLowerCase();
      return (!q||all.includes(q))&&(!listState.size||m.size===listState.size)&&(!listState.rp||(listState.rp.startsWith("Race: ")?m.race===listState.rp.slice(6):m.property===listState.rp.slice(10)));
    });
    rows.sort((a,b)=>listState.sort==="name"?a.name.localeCompare(b.name):listState.sort==="level-desc"?b.lvl-a.lvl:a.lvl-b.lvl);
    const size=6,pageCount=Math.max(1,Math.ceil(rows.length/size));listState.page=Math.min(listState.page,pageCount);
    const paged=rows.slice((listState.page-1)*size,listState.page*size);
    document.getElementById("monsterRows").innerHTML=recordList(paged);
    document.getElementById("listCount").textContent=rows.length+" results";
    document.getElementById("pager").innerHTML='<button type="button" id="prevPage"'+(listState.page===1?' disabled':'')+'>Previous</button><span>Page '+listState.page+' of '+pageCount+'</span><button type="button" id="nextPage"'+(listState.page===pageCount?' disabled':'')+'>Next</button>';
    document.getElementById("prevPage").addEventListener("click",()=>{listState.page--;applyFilters()});
    document.getElementById("nextPage").addEventListener("click",()=>{listState.page++;applyFilters()});
  }
  function wireListing(){
    const bind=(id,key,event)=>document.getElementById(id).addEventListener(event,e=>{listState[key]=e.target.value;listState.page=1;applyFilters();});
    bind("monsterSearch","q","input");bind("size","size","change");bind("raceProperty","rp","change");bind("order","sort","change");
    document.getElementById("filters").addEventListener("submit",e=>e.preventDefault());
    document.getElementById("resetFilter").addEventListener("click",()=>{listState={q:"",size:"",rp:"",sort:"level",page:1};document.getElementById("monsterSearch").value="";document.getElementById("size").value="";document.getElementById("raceProperty").value="";document.getElementById("order").value="level";applyFilters();});
    document.getElementById("order").value=listState.sort;
    applyFilters();
  }
  function detail(id){
    const m=records.find(x=>x.id===id);
    if(!m)return crumb(["Monsters","Not found"])+heading("Monster not found","No matching sample record.")+'<a href="#/monsters">Return to monster list</a>';
    const attr=["Max HP","P.DEF Level","Final P.DEF Increase","M.DEF Level","Final M.DEF Increase","Dodge Rate","Dodge Level","Crit Resist Rate","Crit Resist Level"];
    const related=records.filter(x=>x.id!==m.id).sort((a,b)=>Math.abs(a.lvl-m.lvl)-Math.abs(b.lvl-m.lvl)).slice(0,4);
    return crumb(["Monsters",m.name])+'<div class="page-content">'+
    '<div class="mb-3"><a href="#/monsters" class="small">← All monsters</a></div>'+
    '<div class="hero-record"><div class="sprite-placeholder" role="img" aria-label="Monster image not uploaded"><span>Monster artwork<br>not uploaded</span></div><div class="flex-grow-1"><h1>'+escapeHTML(m.name)+'</h1><div class="meta-tags"><span>Level '+m.lvl+'</span><span>'+escapeHTML(m.property)+'</span><span>'+escapeHTML(m.race)+'</span><span>'+escapeHTML(m.size)+'</span></div><div class="note">Location · '+escapeHTML(m.location)+'</div></div></div>'+
    '<div class="stats-strip">'+["Level","Max HP","Base EXP","Job EXP","Zeny"].map((x,i)=>'<div class="entry"><small>'+x+'</small><b>'+(i===0?m.lvl:"—")+'</b></div>').join("")+'</div>'+
    '<div class="row g-4"><div class="col-lg-7">'+section("Combat Attributes","","")+
    '<div class="section-body"><table class="table detail-table"><tbody>'+attr.map(x=>'<tr><td>'+x+'</td><td>—</td></tr>').join("")+'</tbody></table></div>'+
    section("Spawn Location","","")+'<div class="section-body"><div class="placeholder-message"><strong>'+escapeHTML(m.location)+'</strong><div class="small mt-2">Map illustration is not uploaded.</div></div></div>'+
    section("Monster Skills","","")+'<div class="section-body"><div class="placeholder-message">Skill data will be displayed here when the legacy data source is connected.</div></div></div>'+
    '<div class="col-lg-5">'+section("Monster Drop List","","")+'<div class="section-body">'+m.drops.map(x=>'<div class="item-line"><span>'+escapeHTML(x)+'</span><small>Rate —</small></div>').join("")+'</div>'+
    section("Monsters in the same level range","","")+'<div class="section-body"><div class="related-list">'+related.map(x=>'<a href="#/monsters/'+encodeURIComponent(x.id)+'">'+escapeHTML(x.name)+' <small class="text-secondary">Lv '+x.lvl+'</small></a>').join("")+'</div></div>'+
    '<div class="small text-secondary mt-3">Fields marked — are intentionally blank. Game formulas, actual drops and item relationships require verified backend data.</div></div></div></div>';
  }
  function other(key){
    const c=categories.find(c=>c[2]===key);
    if(!c)return crumb(["Not found"])+heading("Page not found","The requested route does not exist.");
    return crumb([c[0]])+heading(c[0],c[1])+'<div class="slate"><strong>This section is not yet implemented in the preview.</strong><p class="mb-0 mt-2">It will follow the existing legacy module structure after Monster Database and Monster Detail are reviewed. Existing calculator logic is not being replaced with fictional formulas.</p></div>';
  }
  function navigate(){
    const hash=location.hash||"#/",parts=hash.slice(2).split("?")[0].split("/").filter(Boolean);
    const key=parts[0]||"home";
    if(key==="monsters"&&parts[1])app.innerHTML=detail(decodeURIComponent(parts[1]));
    else if(key==="monsters"){const q=new URLSearchParams(hash.split("?")[1]||"").get("q");if(q!==null){listState.q=q;listState.page=1};app.innerHTML='<div class="page-content">'+listing()+'</div>';wireListing();}
    else if(key==="home")app.innerHTML='<div class="page-content">'+home()+'</div>';
    else app.innerHTML='<div class="page-content">'+other(key)+'</div>';
    document.querySelectorAll("[data-nav]").forEach(a=>{const active=a.getAttribute("data-nav")===key;a.classList.toggle("active",active);if(active)a.setAttribute("aria-current","page");else a.removeAttribute("aria-current");});
    const nav=document.getElementById("primaryNav");if(nav.classList.contains("show")&&window.bootstrap)window.bootstrap.Collapse.getOrCreateInstance(nav,{toggle:false}).hide();
    document.title=(key==="home"?"Home":key.charAt(0).toUpperCase()+key.slice(1))+" | ROXPEDIA";
    window.scrollTo(0,0);
  }
  document.getElementById("globalSearch").addEventListener("submit",e=>{e.preventDefault();const q=document.getElementById("searchInput").value.trim();location.hash="#/monsters"+(q?"?q="+encodeURIComponent(q):"");if(location.hash==="#/monsters")navigate();});
  document.addEventListener("keydown",e=>{if(e.key!=="/"||e.ctrlKey||e.altKey||e.metaKey)return;const t=e.target;if(t&&(/INPUT|TEXTAREA|SELECT/.test(t.tagName)||t.isContentEditable))return;const input=document.getElementById("monsterSearch")||document.getElementById("searchInput");if(input){e.preventDefault();input.focus();}});
  window.addEventListener("hashchange",navigate);navigate();
})();