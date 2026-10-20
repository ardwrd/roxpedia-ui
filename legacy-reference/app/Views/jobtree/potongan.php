const jobs = [
    // 🌲 Archer tree
    { id:'archer', name:'Archer', slug:'archer', parentId:null, icon:'<?= base_url("assets/img/job/job_1500.png") ?>' },
    { id:'hunter', name:'Hunter', slug:'hunter', parentId:'archer', icon:'<?= base_url("assets/img/job/job_1510.png") ?>' },
    { id:'bard', name:'Bard', slug:'bard', parentId:'archer', icon:'<?= base_url("assets/img/job/job_1520.png") ?>' },
    { id:'dancer', name:'Dancer', slug:'dancer', parentId:'archer', icon:'<?= base_url("assets/img/job/job_1530.png") ?>' },
    { id:'sniper', name:'Sniper', slug:'sniper', parentId:'hunter', icon:'<?= base_url("assets/img/job/job_1511.png") ?>' },
    { id:'clown', name:'Clown', slug:'clown', parentId:'bard', icon:'<?= base_url("assets/img/job/job_1521.png") ?>' },
    { id:'gypsy', name:'Gypsy', slug:'gypsy', parentId:'dancer', icon:'<?= base_url("assets/img/job/job_1531.png") ?>' },
    { id:'ranger', name:'Ranger', slug:'ranger', parentId:'sniper', icon:'<?= base_url("assets/img/job/job_1512.png") ?>' },
    { id:'minstrel', name:'Minstrel', slug:'minstrel', parentId:'clown', icon:'<?= base_url("assets/img/job/job_1522.png") ?>' },
    { id:'wanderer', name:'Wanderer', slug:'wanderer', parentId:'gypsy', icon:'<?= base_url("assets/img/job/job_1532.png") ?>' },
    { id:'windhawk', name:'Windhawk', slug:'windhawk', parentId:'ranger', icon:'<?= base_url("assets/img/job/job_1513.png") ?>' },
    { id:'troubadour', name:'Troubadour', slug:'troubadour', parentId:'minstrel', icon:'<?= base_url("assets/img/job/job_1523.png") ?>' },
    { id:'trouvere', name:'Trouvere', slug:'trouvere', parentId:'wanderer', icon:'<?= base_url("assets/img/job/job_1533.png") ?>' },

    // ⚔️ Swordsman tree
    { id:'swordsman', name:'Swordsman', slug:'swordsman', parentId:null, icon:'<?= base_url("assets/img/job/job_1100.png") ?>' },
    { id:'knight', name:'Knight', slug:'knight', parentId:'swordsman', icon:'<?= base_url("assets/img/job/job_1110.png") ?>' },
    { id:'crusader', name:'Crusader', slug:'crusader', parentId:'swordsman', icon:'<?= base_url("assets/img/job/job_1120.png") ?>' },
    { id:'lordknight', name:'Lord Knight', slug:'lord-knight', parentId:'knight', icon:'<?= base_url("assets/img/job/job_1111.png") ?>' },
    { id:'paladin', name:'Paladin', slug:'paladin', parentId:'crusader', icon:'<?= base_url("assets/img/job/job_1121.png") ?>' },
    { id:'runeknight', name:'Rune Knight', slug:'rune-knight', parentId:'lordknight', icon:'<?= base_url("assets/img/job/job_1112.png") ?>' },
    { id:'royalguard', name:'Royal Guard', slug:'royal-guard', parentId:'paladin', icon:'<?= base_url("assets/img/job/job_1122.png") ?>' },
    { id:'dragonknight', name:'Dragon Knight', slug:'dragon-knight', parentId:'runeknight', icon:'<?= base_url("assets/img/job/job_1113.png") ?>' },
    { id:'imperialguard', name:'Imperial Guard', slug:'imperial-guard', parentId:'royalguard', icon:'<?= base_url("assets/img/job/job_1123.png") ?>' },

    // ✝️ Acolyte tree
    { id:'acolyte', name:'Acolyte', slug:'acolyte', parentId:null, icon:'<?= base_url("assets/img/job/job_1200.png") ?>' },
    { id:'priest', name:'Priest', slug:'priest', parentId:'acolyte', icon:'<?= base_url("assets/img/job/job_1210.png") ?>' },
    { id:'monk', name:'Monk', slug:'monk', parentId:'acolyte', icon:'<?= base_url("assets/img/job/job_1220.png") ?>' },
    { id:'highpriest', name:'High Priest', slug:'high-priest', parentId:'priest', icon:'<?= base_url("assets/img/job/job_1211.png") ?>' },
    { id:'champion', name:'Champion', slug:'champion', parentId:'monk', icon:'<?= base_url("assets/img/job/job_1221.png") ?>' },
    { id:'archbishop', name:'Archbishop', slug:'archbishop', parentId:'highpriest', icon:'<?= base_url("assets/img/job/job_1212.png") ?>' },
    { id:'shura', name:'Shura', slug:'shura', parentId:'champion', icon:'<?= base_url("assets/img/job/job_1222.png") ?>' },
    { id:'cardinal', name:'Cardinal', slug:'cardinal', parentId:'archbishop', icon:'<?= base_url("assets/img/job/job_1213.png") ?>' },
    { id:'inquisitor', name:'Inquisitor', slug:'inquisitor', parentId:'shura', icon:'<?= base_url("assets/img/job/job_1223.png") ?>' },

    // 🪄 Mage Tree
    { id:'mage', name:'Mage', slug:'mage', parentId:null, icon:'<?= base_url("assets/img/job/job_1300.png") ?>' },
    { id:'wizard', name:'Wizard', slug:'wizard', parentId:'mage', icon:'<?= base_url("assets/img/job/job_1310.png") ?>' },
    { id:'highwizard', name:'High Wizard', slug:'high-wizard', parentId:'wizard', icon:'<?= base_url("assets/img/job/job_1311.png") ?>' },
    { id:'warlock', name:'Warlock', slug:'warlock', parentId:'highwizard', icon:'<?= base_url("assets/img/job/job_1312.png") ?>' },
    { id:'archmage', name:'Arch Mage', slug:'arch-mage', parentId:'warlock', icon:'<?= base_url("assets/img/job/job_1313.png") ?>' },
    { id:'sage', name:'Sage', slug:'sage', parentId:'mage', icon:'<?= base_url("assets/img/job/job_1310.png") ?>' },
    { id:'professor', name:'Professor', slug:'professor', parentId:'sage', icon:'<?= base_url("assets/img/job/job_1311.png") ?>' },
    { id:'sorcerer', name:'Sorcerer', slug:'sorcerer', parentId:'professor', icon:'<?= base_url("assets/img/job/job_1312.png") ?>' },
    { id:'elementalmaster', name:'Elemental Master', slug:'elemental-master', parentId:'sorcerer', icon:'<?= base_url("assets/img/job/job_1313.png") ?>' },

    // 🗡️ Thief Tree
    { id:'thief', name:'Thief', slug:'thief', parentId:null, icon:'<?= base_url("assets/img/job/job_1400.png") ?>' },
    { id:'assassin', name:'Assassin', slug:'assassin', parentId:'thief', icon:'<?= base_url("assets/img/job/job_1410.png") ?>' },
    { id:'assassincross', name:'Assassin Cross', slug:'assassin-cross', parentId:'assassin', icon:'<?= base_url("assets/img/job/job_1411.png") ?>' },
    { id:'guillotinecross', name:'Guillotine Cross', slug:'guillotine-cross', parentId:'assassincross', icon:'<?= base_url("assets/img/job/job_1412.png") ?>' },
    { id:'shadowcross', name:'Shadow Cross', slug:'shadow-cross', parentId:'guillotinecross', icon:'<?= base_url("assets/img/job/job_1413.png") ?>' },
    { id:'rogue', name:'Rogue', slug:'rogue', parentId:'thief', icon:'<?= base_url("assets/img/job/job_1410.png") ?>' },
    { id:'stalker', name:'Stalker', slug:'stalker', parentId:'rogue', icon:'<?= base_url("assets/img/job/job_1411.png") ?>' },
    { id:'shadowchaser', name:'Shadow Chaser', slug:'shadow-chaser', parentId:'stalker', icon:'<?= base_url("assets/img/job/job_1412.png") ?>' },
    { id:'abysschaser', name:'Abyss Chaser', slug:'abyss-chaser', parentId:'shadowchaser', icon:'<?= base_url("assets/img/job/job_1413.png") ?>' },

    // 💼 Merchant tree
    { id:'merchant', name:'Merchant', slug:'merchant', parentId:null, icon:'<?= base_url("assets/img/job/job_1600.png") ?>' },
    { id:'blacksmith', name:'Blacksmith', slug:'blacksmith', parentId:'merchant', icon:'<?= base_url("assets/img/job/job_1610.png") ?>' },
    { id:'alchemist', name:'Alchemist', slug:'alchemist', parentId:'creator', icon:'<?= base_url("assets/img/job/job_1620.png") ?>' },
    { id:'whitesmith', name:'Whitesmith', slug:'whitesmith', parentId:'blacksmith', icon:'<?= base_url("assets/img/job/job_1611.png") ?>' },
    { id:'creator', name:'Creator', slug:'creator', parentId:'merchant', icon:'<?= base_url("assets/img/job/job_1621.png") ?>' },
    { id:'mechanic', name:'Mechanic', slug:'mechanic', parentId:'whitesmith', icon:'<?= base_url("assets/img/job/job_1612.png") ?>' },
    { id:'genetic', name:'Genetic', slug:'genetic', parentId:'alchemist', icon:'<?= base_url("assets/img/job/job_1622.png") ?>' },
    { id:'meister', name:'Meister', slug:'meister', parentId:'mechanic', icon:'<?= base_url("assets/img/job/job_1613.png") ?>' },
    { id:'biolo', name:'Biolo', slug:'biolo', parentId:'genetic', icon:'<?= base_url("assets/img/job/job_1623.png") ?>' },

    // 🔫 Gunslinger tree
    { id:'gunslinger', name:'Gunslinger', slug:'gunslinger', parentId:null, icon:'<?= base_url("assets/img/job/job_1700.png") ?>' },
    { id:'rebellion', name:'Rebellion', slug:'rebellion', parentId:'gunslinger', icon:'<?= base_url("assets/img/job/job_1710.png") ?>' },
    { id:'gunmaster', name:'Gunmaster', slug:'gunmaster', parentId:'rebellion', icon:'<?= base_url("assets/img/job/job_1711.png") ?>' },
    { id:'predator', name:'Predator', slug:'predator', parentId:'gunmaster', icon:'<?= base_url("assets/img/job/job_1712.png") ?>' },
    { id:'nightwatch', name:'Night Watch', slug:'night-watch', parentId:'predator', icon:'<?= base_url("assets/img/job/job_1713.png") ?>' },    

    // 🥷 Ninja tree
    { id:'ninja', name:'Ninja', slug:'ninja', parentId:null, icon:'<?= base_url("assets/img/job/job_1800.png") ?>' },
    { id:'kagerou', name:'Kagerou', slug:'kagerou', parentId:'ninja', icon:'<?= base_url("assets/img/job/job_1810.png") ?>' },
    { id:'yata', name:'Yata', slug:'yata', parentId:'kagerou', icon:'<?= base_url("assets/img/job/job_1811.png") ?>' },
    { id:'susa', name:'Susa', slug:'susa', parentId:'yata', icon:'<?= base_url("assets/img/job/job_1812.png") ?>' },
    { id:'shinkiro', name:'Shinkiro', slug:'shinkiro', parentId:'susa', icon:'<?= base_url("assets/img/job/job_1813.png") ?>' },
    { id:'oboro', name:'Oboro', slug:'oboro', parentId:'ninja', icon:'<?= base_url("assets/img/job/job_1820.png") ?>' },
    { id:'murakumo', name:'Murakumo', slug:'murakumo', parentId:'oboro', icon:'<?= base_url("assets/img/job/job_1821.png") ?>' },
    { id:'shiranui', name:'Shiranui', slug:'shiranui', parentId:'murakumo', icon:'<?= base_url("assets/img/job/job_1822.png") ?>' },
    { id:'tsukuyomi', name:'Tsukuyomi', slug:'tsukuyomi', parentId:'shiranui', icon:'<?= base_url("assets/img/job/job_1823.png") ?>' },    

    // 🥋 Taekwon tree
    { id:'taekwon', name:'Taekwon', slug:'taekwon', parentId:null, icon:'<?= base_url("assets/img/job/job_1900.png") ?>' },
    { id:'stargladiator', name:'Star Gladiator', slug:'star-gladiator', parentId:'taekwon', icon:'<?= base_url("assets/img/job/job_1910.png") ?>' },
    { id:'starMonarch', name:'Star Monarch', slug:'star-monarch', parentId:'stargladiator', icon:'<?= base_url("assets/img/job/job_1911.png") ?>' },
    { id:'stellarFist', name:'Stellar Fist', slug:'stellar-fist', parentId:'starMonarch', icon:'<?= base_url("assets/img/job/job_1912.png") ?>' },
    { id:'skyEmperor', name:'Sky Emperor', slug:'sky-emperor', parentId:'stellarFist', icon:'<?= base_url("assets/img/job/job_1913.png") ?>' },    

    // 🌱 Novice tree
    { id:'supernovice', name:'Super Novice', slug:'novice', parentId:null, icon:'<?= base_url("assets/img/job/job_1000.png") ?>' },
    { id:'expandedsupernovice', name:'Expanded Super Novice', slug:'expanded-super-novice', parentId:'supernovice', icon:'<?= base_url("assets/img/job/job_1011.png") ?>' },
    { id:'ultrasupernovice', name:'Ultra Super Novice', slug:'ultra-super-novice', parentId:'expandedsupernovice', icon:'<?= base_url("assets/img/job/job_1012.png") ?>' },
    { id:'elevatednovice', name:'Elevated Novice', slug:'elevated-novice', parentId:'ultrasupernovice', icon:'<?= base_url("assets/img/job/job_1013.png") ?>' },
    { id:'hypernovice', name:'Hyper Novice', slug:'hyper-novice', parentId:'elevatednovice', icon:'<?= base_url("assets/img/job/job_1014.png") ?>' }
];


    <footer class="pt-3 mt-4 text-body-secondary border-top">
      <p>&copy; <span id="current-year"></span> Created by <b>ROXPEDIA Team</b> — All rights reserved.<br/>
        Ragnarok X: Next Generation related images and contents are copyrighted by Gravity Co. and Lee MyoungJin (Studio DDTS).
      </p>
    </footer>