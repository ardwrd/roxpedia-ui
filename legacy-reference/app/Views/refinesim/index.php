<?php
$simConfigJson = json_encode($simConfig ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ROXPEDIA Team">
  <meta name="description" content="Simulate item refining in Ragnarok X: Next Generation with pity, broken, downgrade, and protection stones.">
  <meta name="keywords" content="Ragnarok X, Refine Simulator, Pity System, Broken, Protection Stone, Blessed Stone, Blessing Stone">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <meta property="og:title" content="Refine Simulator Ragnarok X: Next Generation">
  <meta property="og:description" content="Refine Simulator with pity system, broken state, and protection stones.">
  <meta property="og:image" content="<?= base_url('assets/logo.png') ?>">
  <meta property="og:url" content="<?= site_url('refinesim') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Refine Simulator Ragnarok X: Next Generation">
  <meta name="twitter:description" content="Refine Simulator with pity system, broken state, and protection stones.">
  <meta name="twitter:image" content="<?= base_url('assets/logo.png') ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <link rel="canonical" href="<?= site_url('refinesim') ?>">
  <meta http-equiv="content-language" content="en">
  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">

  <title>Refine Simulator Ragnarok X: Next Generation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <!-- Tidak ada custom CSS untuk input harga (karena sudah dihapus).
       Ini hanya mempertahankan wrapper gambar yang sudah kamu pakai dari awal. -->
  <style>
    .image-container {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 200px;
      height: 200px;
      margin: 0 auto;
    }

    .badge-position {
      position: absolute;
      top: 30px;
      right: 30px;
      z-index: 2;
    }

    .checkbox-group {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin-top: 10px;
      flex-wrap: wrap;
    }

    .item-image-wrapper {
      width: 170px;
      height: 170px;
      margin: auto;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 10px;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .item-image {
      width: 70%;
      height: 70%;
      object-fit: contain;
    }
  </style>
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main class="container-fluid">
      <div class="row g-3">

        <!-- Simulator Card -->
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card h-100">
            <div class="pt-3">
              <div class="image-container">
                <div class="item-image-wrapper" id="equipmentWrapper">
                  <img src="<?= base_url('assets/img/refinement.png'); ?>" alt="Equipment" class="item-image" id="equipmentImage">

                </div>
                <span class="badge rounded-pill bg-primary badge-position" id="refineLevel">0</span>
              </div>
            </div>

            <div class="card-body text-center">
              <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-primary" type="button" onclick="refineItem()">Refine</button>
                <button class="btn btn-outline-secondary" type="button" onclick="resetSim()">Reset</button>
              </div>

              <div class="mt-3 d-flex justify-content-center">
                <div class="d-flex flex-column gap-2 text-start" style="min-width: 220px;">
                  <div id="blessedStoneWrapper" style="display:none;">
                    <div class="form-check m-0">
                      <input class="form-check-input" type="checkbox" id="blessedStone" onclick="handleStoneSelection()">
                      <label class="form-check-label small" for="blessedStone">Blessed (anti-break)</label>
                    </div>
                  </div>

                  <div id="protectionStoneWrapper" style="display:none;">
                    <div class="form-check m-0">
                      <input class="form-check-input" type="checkbox" id="protectionStone" onclick="handleStoneSelection()">
                      <label class="form-check-label small" for="protectionStone">Protection (no downgrade)</label>
                    </div>
                  </div>

                  <div id="blessingStoneWrapper" style="display:none;">
                    <div class="form-check m-0">
                      <input class="form-check-input" type="checkbox" id="blessingStone" onclick="handleStoneSelection()">
                      <label class="form-check-label small" for="blessingStone">Blessing (Premium)</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-3">
                <div id="resultMessage" class="small"></div>
              </div>

              <!-- Pity -->
              <div class="mt-3 text-start">
                <div class="d-flex justify-content-between small mb-1">
                  <span>Pity: <span id="pityPointsText">0</span> / 5000</span>
                  <span>Stage: <span id="pityStageText">1</span></span>
                </div>
                <div class="progress" role="progressbar" aria-label="Pity bar">
                  <div id="pityBar" class="progress-bar" style="width:0%"></div>
                </div>
                <div class="text-body-secondary small mt-1">
                  Pity resets on success. Guarantee triggers at 5000 points (checked before RNG).
                </div>
              </div>

              <!-- Broken -->
              <div class="mt-3" id="brokenPanel" style="display:none;">
                <div class="alert alert-warning py-2 mb-2 small text-center">
                  Equipment is <b>BROKEN</b>. Repair/Transfer required to continue.
                </div>
                <div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-outline-warning btn-sm" type="button" id="btnRepair">Repair</button>
                  <button class="btn btn-outline-info btn-sm" type="button" id="btnTransfer">Transfer</button>
                </div>
              </div>

              <!-- Stats -->
              <div class="mt-3 small">
                <span>Failed Rate: <span id="failedRate">0%</span></span>
                <span class="mx-2">|</span>
                <span>Break Rate: <span id="breakRate">0%</span></span>
              </div>

            </div>
          </div>
        </div>

        <!-- Refine Tools -->
        <div class="col-lg-8 col-md-6 col-12">
          <div class="card h-100">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Refine Tools</h5>
              </div>
              <div class="pt-3">
                <form id="equipmentForm">
                  <div class="row g-3">
                    <div class="col-md-4 col-12">
                      <label for="equipmentType" class="form-label">Equipment Type</label>
                      <select id="equipmentType" class="form-select">
                        <option value="">Select Equipment Type</option>
                        <option value="Weapon">Weapon</option>
                        <option value="Armor">Armor</option>
                        <option value="Decoration">Decoration</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-12" id="weaponTypeWrapper" style="display:none;">
                      <label for="weaponType" class="form-label">Weapon Type</label>
                      <select id="weaponType" class="form-select">
                        <option value="">Select Weapon Type</option>
                        <option value="One-Handed">One-Handed</option>
                        <option value="Shield">Shield</option>
                        <option value="Two-Handed">Two-Handed</option>
                        <option value="Dagger">Dagger</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-12" id="decorationTypeWrapper" style="display:none;">
                      <label for="decorationType" class="form-label">Decoration Type</label>
                      <select id="decorationType" class="form-select">
                        <option value="">Select Decoration Type</option>
                        <option value="Accessory">Accessory</option>
                        <option value="Talisman">Talisman</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-12" id="rarityWrapper" style="display:none;">
                      <label for="raritySelect" class="form-label">Rarity</label>
                      <select id="raritySelect" class="form-select">
                        <option value="">Select Rarity</option>
                      </select>
                    </div>
                  </div>
                </form>

                <div class="mt-3 small text-body-secondary">
                  Rules (manual):
                  <ul class="mb-0">
                    <li>Level 0-3: fail does not downgrade/break.</li>
                    <li>Break and downgrade start from +4 -> +5 (target >= 5).</li>
                    <li>Blessed: anti-break only. Protection: no downgrade (safe rate). Premium: no break & no downgrade.</li>
                    <li>Pity: +points on non-success, reset on success, guarantee at 5000.</li>
                  </ul>
                </div>

                <div class="mt-4 border rounded p-3">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Manual Material Pricing</h6>
                  </div>
                  <div class="row g-2 align-items-end">
                    <div class="col-md-4 col-12">
                      <label for="manualCostMode" class="form-label small">Manual Cost Mode</label>
                      <select id="manualCostMode" class="form-select form-select-sm">
                        <option value="exchange">Full Buy (Exchange / Crystal)</option>
                        <option value="crafting">Crafting (Use Owned First)</option>
                      </select>
                    </div>
                    <div class="col-md-8 col-12 small text-body-secondary">
                      Material list appears after you select equipment + rarity. Price here is reused for manual refine cost.
                    </div>
                  </div>
                  <div id="manualMaterialPricingRows" class="mt-2 small text-body-secondary">Select equipment and rarity first.</div>
                </div>

                <div class="mt-4 border rounded p-3">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0">Manual Refine Cost</h6>
                  </div>
                  <div id="manualCostLastMeta" class="small text-body-secondary">No refine attempts yet.</div>
                  <div class="small text-body-secondary">Zeny is process cost per click. Crystal cost is calculated from Manual Material Pricing panel.</div>
                  <div class="small mt-1">
                    Last Attempt:
                    <span class="ms-1">Zeny <b id="manualCostLastZeny">0</b></span>
                    <span class="ms-2">Luck <b id="manualCostLastLuck">0</b></span>
                  </div>
                  <div id="manualCostLastMaterials" class="small mt-1 text-body-secondary">-</div>
                  <div class="border-top mt-2 pt-2 small">
                    Session:
                    <span class="ms-1">Attempts <b id="manualCostSessionAttempts">0</b></span>
                    <span class="ms-2">Zeny <b id="manualCostSessionZeny">0</b></span>
                    <span class="ms-2">Luck <b id="manualCostSessionLuck">0</b></span>
                  </div>
                  <div id="manualCostSessionMaterials" class="small mt-1 text-body-secondary">-</div>
                  <div class="row g-2 small mt-2">
                    <div class="col-12 col-md-6">
                      <div class="border rounded p-2">
                        Last Attempt Crystal Cost<br>
                        <b id="manualCostLastCrystal">0</b>
                        <div class="text-body-secondary">Buy Qty: <b id="manualCostLastBuyQty">0</b></div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="border rounded p-2">
                        Session Crystal Cost<br>
                        <b id="manualCostSessionCrystal">0</b>
                        <div class="text-body-secondary">Buy Qty: <b id="manualCostSessionBuyQty">0</b></div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="border rounded p-2">
                        Currency Summary<br>
                        <b id="manualCostCurrencySummary">Zeny: 0 | Crystal: 0</b>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script>
    /** ========= YEAR ========= */
    document.addEventListener("DOMContentLoaded", () => {
      const y = document.getElementById("current-year");
      if (y) y.innerText = new Date().getFullYear();
    });

    /** ========= MODES ========= */
    const Mode = {
      NONE: "none", // regular table
      SAFE: "safe", // protection stone (safe rate, no downgrade)
      PREMIUM: "premium" // blessing stone (no break & no downgrade)
    };

    /** ========= DB CONFIG ========= */
    const SIM_CONFIG = <?= $simConfigJson !== false ? $simConfigJson : '{}' ?>;
    const PITY_REQUIRED = Number(SIM_CONFIG.pity_required ?? 5000);
    const REGULAR_RATE_BY_QUALITY = SIM_CONFIG.regular_rate_by_quality ?? {};
    const SAFE_RATE_BY_QUALITY = SIM_CONFIG.safe_rate_by_quality ?? {};
    const PITY_POINTS = SIM_CONFIG.pity_points ?? {};
    const COST_PROFILES = SIM_CONFIG.cost_profiles ?? {};
    const PROTECTION_PROFILES = SIM_CONFIG.protection_profiles ?? {};
    const RARITY_QUALITY_MAP = {
      White: 1,
      Blue: 2,
      Purple: 3,
      Gold: 4
    };
    const REPRESENTATIVE_IMAGES = SIM_CONFIG.representative_images ?? {};
    const ITEM_IMAGE_BASE_URL = "<?= base_url('assets/img/items/') ?>";
    const DEFAULT_EQUIP_IMAGE_URL = "<?= base_url('assets/img/refinement.png') ?>";
    const WEAPON_SUBTYPE_KEY_MAP = {
      "One-Handed": "one_handed",
      "Shield": "shield",
      "Two-Handed": "two_handed",
      "Dagger": "dagger",
    };
    const DECORATION_SUBTYPE_KEY_MAP = {
      "Accessory": "accessory",
      "Talisman": "talisman",
    };

    function pityStage(points) {
      return Math.min(5, Math.floor(points / 1000) + 1);
    }

    function pityStageIdx(points) {
      return Math.min(4, Math.floor(points / 1000));
    }

    function getQualityFromRarity(rarity) {
      return RARITY_QUALITY_MAP[rarity] ?? 1;
    }

    function getRegularRate(quality, target) {
      const qRates = REGULAR_RATE_BY_QUALITY[String(quality)] ?? REGULAR_RATE_BY_QUALITY["1"] ?? {};
      return qRates[String(target)] ?? qRates[target] ?? null;
    }

    function getSafeRate(quality, target) {
      const qRates = SAFE_RATE_BY_QUALITY[String(quality)] ?? SAFE_RATE_BY_QUALITY["1"] ?? {};
      return qRates[String(target)] ?? qRates[target] ?? null;
    }

    function getAvailableRarities(equipmentType, weaponType, decorationType) {
      const order = ["White", "Blue", "Purple", "Gold"];
      let rarityObject = null;

      if (equipmentType === "Weapon") {
        const key = WEAPON_SUBTYPE_KEY_MAP[weaponType ?? ""] ?? "";
        rarityObject = key ? (COST_PROFILES?.weapon?.[key] ?? null) : null;
      } else if (equipmentType === "Armor") {
        rarityObject = COST_PROFILES?.armor?.default ?? null;
      } else if (equipmentType === "Decoration") {
        const key = DECORATION_SUBTYPE_KEY_MAP[decorationType ?? ""] ?? "";
        rarityObject = key ? (COST_PROFILES?.decoration?.[key] ?? null) : null;
      }

      if (!rarityObject || typeof rarityObject !== "object") {
        if (equipmentType === "Weapon") return ["White", "Blue", "Gold"];
        if (equipmentType === "Armor") return ["White", "Blue", "Purple"];
        if (equipmentType === "Decoration") return ["White", "Blue", "Gold"];
        return [];
      }

      const available = order.filter((rarity) => {
        const rows = rarityObject[rarity];
        return rows && typeof rows === "object" && Object.keys(rows).length > 0;
      });

      if (available.length > 0) {
        return available;
      }

      if (equipmentType === "Weapon") return ["White", "Blue", "Gold"];
      if (equipmentType === "Armor") return ["White", "Blue", "Purple"];
      if (equipmentType === "Decoration") return ["White", "Blue", "Gold"];
      return [];
    }

    function resolveEquipmentImageFile(selection) {
      if (!selection) return null;

      const equipType = selection.equipmentType ?? "";
      const weaponType = selection.weaponType ?? "";
      const decorationType = selection.decorationType ?? "";
      const rarity = selection.rarity ?? "";
      if (!equipType || !rarity) return null;

      if (equipType === "Weapon") {
        const subtypeKey = WEAPON_SUBTYPE_KEY_MAP[weaponType] ?? "";
        if (!subtypeKey) return null;
        return REPRESENTATIVE_IMAGES?.weapon?.[subtypeKey]?.[rarity] ?? null;
      }

      if (equipType === "Armor") {
        return REPRESENTATIVE_IMAGES?.armor?.[rarity] ?? null;
      }

      if (equipType === "Decoration") {
        const subtypeKey = DECORATION_SUBTYPE_KEY_MAP[decorationType] ?? "";
        if (!subtypeKey) return null;
        return REPRESENTATIVE_IMAGES?.decoration?.[subtypeKey]?.[rarity] ?? null;
      }

      return null;
    }

    function updateEquipmentPreviewImage() {
      const imageEl = document.getElementById("equipmentImage");
      if (!imageEl) return;

      const selection = {
        equipmentType: document.getElementById("equipmentType")?.value ?? "",
        weaponType: document.getElementById("weaponType")?.value ?? "",
        decorationType: document.getElementById("decorationType")?.value ?? "",
        rarity: document.getElementById("raritySelect")?.value ?? "",
      };
      const imageFile = resolveEquipmentImageFile(selection);

      if (!imageFile) {
        imageEl.onerror = null;
        imageEl.src = DEFAULT_EQUIP_IMAGE_URL;
        return;
      }

      imageEl.dataset.fallbackApplied = "0";
      imageEl.onerror = () => {
        if (imageEl.dataset.fallbackApplied === "1") return;
        imageEl.dataset.fallbackApplied = "1";
        imageEl.src = DEFAULT_EQUIP_IMAGE_URL;
      };
      imageEl.src = ITEM_IMAGE_BASE_URL + imageFile;
    }

    /** ========= AUTO ANALYS ========= */
    const AUTO_ANALYSIS_RUNS = 1200;
    const AUTO_ANALYSIS_MAX_ATTEMPTS_PER_RUN = 25000;

    const costAnalysisState = {
      mode: "exchange",
      refineMode: Mode.NONE,
      blessedEnabled: false,
      modeFallbackTargets: [],
      materials: [],
      totalZeny: 0,
      totalLuck: 0,
      expectedAttempts: 0,
      startLevel: 0,
      targetLevel: 1,
      simulationRuns: 0,
      droppedRuns: 0,
      missingLevels: [],
      missingProtectionLevels: [],
    };

    const manualCostState = {
      attempts: 0,
      totalZeny: 0,
      totalLuck: 0,
      totalMaterials: {},
      lastAttempt: null,
    };

    const manualPricingState = {
      catalogMaterials: [],
    };

    const materialInputState = {};
    const manualMaterialInputState = {};

    function escapeHtml(value) {
      return String(value ?? "").replace(/[&<>"']/g, (ch) => {
        if (ch === "&") return "&amp;";
        if (ch === "<") return "&lt;";
        if (ch === ">") return "&gt;";
        if (ch === "\"") return "&quot;";
        return "&#39;";
      });
    }

    function formatInt(value) {
      return Number(value ?? 0).toLocaleString("en-US");
    }

    function formatQty(value) {
      const num = Number(value ?? 0);
      if (Math.abs(num - Math.round(num)) < 0.0001) {
        return formatInt(num);
      }
      return num.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }

    function formatCount(value) {
      const num = Number(value ?? 0);
      const normalized = Number.isFinite(num) ? Math.max(0, Math.ceil(num)) : 0;
      return formatInt(normalized);
    }

    function parseOwnedCount(value) {
      const num = Number.parseFloat(String(value ?? 0));
      if (!Number.isFinite(num)) return 0;
      return Math.max(0, Math.floor(num));
    }

    function formatMoney(value) {
      return Number(value ?? 0).toLocaleString("en-US", {
        maximumFractionDigits: 2
      });
    }

    function normalizeMaterialName(rawName) {
      const cleaned = String(rawName ?? "").replace(/[^\x20-\x7E]/g, "").trim();
      return cleaned || "Unknown Material";
    }

    function clampPityPoints(points) {
      return Math.max(0, Math.min(PITY_REQUIRED, Number(points ?? 0)));
    }

    function hashStringToUint32(text) {
      let hash = 2166136261 >>> 0;
      const source = String(text ?? "");
      for (let i = 0; i < source.length; i++) {
        hash ^= source.charCodeAt(i);
        hash = Math.imul(hash, 16777619);
      }
      return hash >>> 0;
    }

    function createSeededRng(seed) {
      let state = (Number(seed) >>> 0) || 1;
      return function nextRandom() {
        state = (Math.imul(1664525, state) + 1013904223) >>> 0;
        return state / 4294967296;
      };
    }

    function getMaterialInput(itemId) {
      const key = String(itemId);
      if (!materialInputState[key]) {
        materialInputState[key] = {
          price: "",
          owned: ""
        };
      }
      return materialInputState[key];
    }

    function getManualMaterialInput(itemId) {
      const key = String(itemId);
      if (!manualMaterialInputState[key]) {
        manualMaterialInputState[key] = {
          price: "",
          owned: ""
        };
      }
      return manualMaterialInputState[key];
    }

    function getManualCostMode() {
      const modeEl = document.getElementById("manualCostMode");
      return modeEl?.value === "crafting" ? "crafting" : "exchange";
    }

    function computeCrystalTotalsFromMaterials(materials, mode, inputGetter) {
      const list = Array.isArray(materials) ? materials : [];
      let totalBuyQty = 0;
      let totalBuyCost = 0;

      list.forEach((mat) => {
        const input = inputGetter(mat.id);
        const price = Math.max(0, Number.parseFloat(String(input.price || 0)) || 0);
        const owned = parseOwnedCount(input.owned);
        const required = Math.ceil(Number(mat.qty || 0));
        const buyQty = mode === "crafting" ? Math.max(0, required - owned) : required;
        const buyCost = buyQty * price;
        totalBuyQty += buyQty;
        totalBuyCost += buyCost;
      });

      return {
        totalBuyQty,
        totalBuyCost
      };
    }

    function getCostProfileBySelection(selection) {
      if (!selection) return null;
      const rarity = selection.rarity ?? "";
      if (!rarity) return null;

      if (selection.equipmentType === "Weapon") {
        const key = WEAPON_SUBTYPE_KEY_MAP[selection.weaponType ?? ""] ?? "";
        if (!key) return null;
        return COST_PROFILES?.weapon?.[key]?.[rarity] ?? null;
      }

      if (selection.equipmentType === "Armor") {
        return COST_PROFILES?.armor?.default?.[rarity] ?? null;
      }

      if (selection.equipmentType === "Decoration") {
        const key = DECORATION_SUBTYPE_KEY_MAP[selection.decorationType ?? ""] ?? "";
        if (!key) return null;
        return COST_PROFILES?.decoration?.[key]?.[rarity] ?? null;
      }

      return null;
    }

    function getProtectionProfileBySelection(selection) {
      if (!selection) return null;
      const rarity = selection.rarity ?? "";
      if (!rarity) return null;

      if (selection.equipmentType === "Weapon") {
        const key = WEAPON_SUBTYPE_KEY_MAP[selection.weaponType ?? ""] ?? "";
        if (!key) return null;
        return PROTECTION_PROFILES?.weapon?.[key]?.[rarity] ?? null;
      }

      if (selection.equipmentType === "Armor") {
        return PROTECTION_PROFILES?.armor?.default?.[rarity] ?? null;
      }

      if (selection.equipmentType === "Decoration") {
        const key = DECORATION_SUBTYPE_KEY_MAP[selection.decorationType ?? ""] ?? "";
        if (!key) return null;
        return PROTECTION_PROFILES?.decoration?.[key]?.[rarity] ?? null;
      }

      return null;
    }

    function getCostLevelData(selection, targetLevel) {
      const profile = getCostProfileBySelection(selection);
      if (!profile) return null;
      return profile[String(targetLevel)] ?? profile[targetLevel] ?? null;
    }

    function getProtectionLevelData(selection, targetLevel) {
      const profile = getProtectionProfileBySelection(selection);
      if (!profile) return null;
      return profile[String(targetLevel)] ?? profile[targetLevel] ?? null;
    }

    function getMaxProfileLevel(profile) {
      if (!profile || typeof profile !== "object") return 0;
      let maxLevel = 0;
      Object.keys(profile).forEach((key) => {
        const level = Number.parseInt(String(key), 10);
        if (Number.isFinite(level) && level > maxLevel) {
          maxLevel = level;
        }
      });
      return maxLevel;
    }

    function getProtectionMaxLevelBySelection(selection) {
      const profile = getProtectionProfileBySelection(selection);
      return getMaxProfileLevel(profile);
    }

    function mergeMaterialIntoCatalogMap(catalogMap, mat) {
      const itemId = Number(mat?.id ?? 0);
      if (itemId <= 0) return;

      if (!catalogMap[itemId]) {
        catalogMap[itemId] = {
          id: itemId,
          name: normalizeMaterialName(mat?.name),
          image_file: mat?.image_file ? String(mat.image_file) : null,
          qty: 0,
        };
      }
    }

    function collectManualCatalogMaterials(selection) {
      if (!selection) return [];
      const catalogMap = {};

      const costProfile = getCostProfileBySelection(selection);
      if (costProfile && typeof costProfile === "object") {
        Object.values(costProfile).forEach((row) => {
          if (!row || typeof row !== "object") return;
          mergeMaterialIntoCatalogMap(catalogMap, row.normal_material);
          mergeMaterialIntoCatalogMap(catalogMap, row.special_material);
        });
      }

      const protectionProfile = getProtectionProfileBySelection(selection);
      if (protectionProfile && typeof protectionProfile === "object") {
        Object.values(protectionProfile).forEach((row) => {
          if (!row || typeof row !== "object") return;
          mergeMaterialIntoCatalogMap(catalogMap, row);
        });
      }

      return materialMapToSortedArray(catalogMap);
    }

    function getManualSessionQtyByItemId(itemId) {
      const material = manualCostState.totalMaterials?.[itemId];
      return Number(material?.qty ?? 0);
    }

    function normalizeCostRange(startRaw, targetRaw) {
      let start = Number.parseInt(String(startRaw ?? 0), 10);
      let target = Number.parseInt(String(targetRaw ?? 1), 10);
      if (!Number.isFinite(start)) start = 0;
      if (!Number.isFinite(target)) target = 1;
      start = Math.max(0, Math.min(14, start));
      target = Math.max(1, Math.min(15, target));
      if (target <= start) {
        target = Math.min(15, start + 1);
      }
      return {
        start,
        target
      };
    }

    function getAnalysisRefineMode() {
      const modeValue = document.getElementById("analysisRefineMode")?.value ?? Mode.NONE;
      if (modeValue === Mode.SAFE || modeValue === Mode.PREMIUM) return modeValue;
      return Mode.NONE;
    }

    function isAnalysisBlessedEnabled() {
      const blessed = document.getElementById("analysisBlessedStone");
      if (!blessed) return false;
      const refineMode = getAnalysisRefineMode();
      if (refineMode === Mode.PREMIUM) return false;
      return !!blessed.checked;
    }

    function syncAnalysisBlessedAvailability() {
      const blessed = document.getElementById("analysisBlessedStone");
      if (!blessed) return;
      const refineMode = getAnalysisRefineMode();
      const blocked = refineMode === Mode.PREMIUM;
      blessed.disabled = blocked;
      if (blocked) {
        blessed.checked = false;
      }
    }

    function resolveAutoEffectiveMode(currentLevel, selectedMode) {
      if (currentLevel < 4) {
        return Mode.NONE;
      }
      if (selectedMode === Mode.PREMIUM) {
        const premiumAllowed = canUseBlessingTier1(currentLevel) || canUseBlessingTier2(currentLevel);
        return premiumAllowed ? Mode.PREMIUM : Mode.NONE;
      }
      if (selectedMode === Mode.SAFE) {
        return Mode.SAFE;
      }
      return Mode.NONE;
    }

    function resolveAutoEffectiveBlessed(currentLevel, selectedMode, selectedBlessed) {
      if (!selectedBlessed) return false;
      if (currentLevel < 4) return false;
      const effectiveMode = resolveAutoEffectiveMode(currentLevel, selectedMode);
      return effectiveMode !== Mode.PREMIUM;
    }

    function collectAutoModeFallbackTargets(startLevel, targetLevel, selectedMode) {
      const fallbackTargets = [];
      if (selectedMode === Mode.NONE) return fallbackTargets;

      for (let level = startLevel; level < targetLevel; level++) {
        const target = level + 1;
        const effectiveMode = resolveAutoEffectiveMode(level, selectedMode);
        if (effectiveMode !== selectedMode) {
          fallbackTargets.push(target);
        }
      }
      return fallbackTargets;
    }

    function getAnalysisSelection() {
      const equipmentType = document.getElementById("analysisEquipmentType")?.value ?? "";
      const weaponType = document.getElementById("analysisWeaponType")?.value ?? "";
      const decorationType = document.getElementById("analysisDecorationType")?.value ?? "";
      const rarity = document.getElementById("analysisRaritySelect")?.value ?? "";
      if (!equipmentType || !rarity) return null;
      if (equipmentType === "Weapon" && !weaponType) return null;
      if (equipmentType === "Decoration" && !decorationType) return null;
      return {
        equipmentType,
        weaponType,
        decorationType,
        rarity,
        quality: getQualityFromRarity(rarity)
      };
    }

    function getPityFromMap(pityMap, target) {
      return Number(pityMap[target] ?? 0);
    }

    function setPityForMap(pityMap, target, value) {
      pityMap[target] = clampPityPoints(value);
    }

    function buildAnalysisSeed(selection, start, target, refineMode, blessedEnabled) {
      const key = [
        selection.equipmentType || "",
        selection.weaponType || "",
        selection.decorationType || "",
        selection.rarity || "",
        String(start),
        String(target),
        String(refineMode || Mode.NONE),
        blessedEnabled ? "blessed" : "no_blessed",
      ].join("|");
      return hashStringToUint32(key);
    }

    function applyBlessedToProb(prob, refineMode, blessedEnabled) {
      if (!prob) return null;
      if (!blessedEnabled) return prob;
      if (refineMode === Mode.PREMIUM) return prob;
      return {
        s: Number(prob.s ?? 0),
        f: Number(prob.f ?? 0) + Number(prob.b ?? 0),
        d: Number(prob.d ?? 0),
        b: 0,
      };
    }

    function simulateAutoRun(selection, startLevel, targetLevel, refineMode, blessedEnabled, rng) {
      const quality = selection.quality ?? 1;
      let level = startLevel;
      let attempts = 0;
      let zeny = 0;
      let luck = 0;
      const materialMap = {};
      const missingLevels = new Set();
      const missingProtectionLevels = new Set();
      const pityMap = {};
      const maxProtectionLevel = getProtectionMaxLevelBySelection(selection);

      while (level < targetLevel && attempts < AUTO_ANALYSIS_MAX_ATTEMPTS_PER_RUN) {
        attempts += 1;
        const target = level + 1;
        const effectiveMode = resolveAutoEffectiveMode(level, refineMode);
        const effectiveBlessed = resolveAutoEffectiveBlessed(level, refineMode, blessedEnabled);
        const attemptCost = getAttemptCostData(selection, target, effectiveMode);
        if (!attemptCost) {
          missingLevels.add(target);
        } else {
          zeny += Number(attemptCost.zeny ?? 0);
          luck += Number(attemptCost.luck ?? 0);
          attemptCost.materials.forEach((mat) => mergeMaterialRowIntoMap(materialMap, mat));
        }

        if (effectiveMode === Mode.SAFE && target >= 5 && target <= maxProtectionLevel) {
          const protection = getProtectionLevelData(selection, target);
          const protectionId = Number(protection?.id ?? 0);
          const protectionQty = Number(protection?.qty ?? 0);
          if (!protection || protectionId <= 0 || protectionQty <= 0) {
            missingProtectionLevels.add(target);
          }
        }

        if (target <= 4) {
          const successRate = Number(getRegularRate(quality, target)?.s ?? 0);
          if (rng() < successRate) {
            level = target;
            setPityForMap(pityMap, target, 0);
          } else {
            const current = getPityFromMap(pityMap, target);
            const gain = getPityGain(target, effectiveMode, current);
            setPityForMap(pityMap, target, current + gain);
          }
          continue;
        }

        if (getPityFromMap(pityMap, target) >= PITY_REQUIRED) {
          level = target;
          setPityForMap(pityMap, target, 0);
          continue;
        }

        const prob = getOutcomeProb(target, effectiveMode, quality);
        if (!prob) {
          missingLevels.add(target);
          break;
        }

        const finalProb = applyBlessedToProb(prob, effectiveMode, effectiveBlessed);
        const outcome = rollOutcome(finalProb, rng);
        if (outcome !== "success") {
          const current = getPityFromMap(pityMap, target);
          const gain = getPityGain(target, effectiveMode, current);
          setPityForMap(pityMap, target, current + gain);
        } else {
          setPityForMap(pityMap, target, 0);
        }

        if (outcome === "success") {
          level = target;
        } else if (outcome === "downgrade") {
          level = Math.max(3, level - 1);
        }
      }

      return {
        completed: level >= targetLevel,
        attempts,
        zeny,
        luck,
        materialMap,
        missingLevels: Array.from(missingLevels),
        missingProtectionLevels: Array.from(missingProtectionLevels),
      };
    }

    function analyzeCostPlan() {
      const resultEl = document.getElementById("autoAnalysisResult");
      if (!resultEl) return;

      const selection = getAnalysisSelection();
      if (!selection) {
        resultEl.innerHTML = '<div class="alert alert-secondary py-2 mb-0 small">Select equipment type/subtype and rarity first.</div>';
        return;
      }

      const startEl = document.getElementById("analysisStartLevel");
      const targetEl = document.getElementById("analysisTargetLevel");
      const modeEl = document.getElementById("analysisCostMode");
      const {
        start,
        target
      } = normalizeCostRange(startEl?.value, targetEl?.value);
      if (startEl) startEl.value = String(start);
      if (targetEl) targetEl.value = String(target);

      const costMode = modeEl?.value === "crafting" ? "crafting" : "exchange";
      const refineMode = getAnalysisRefineMode();
      syncAnalysisBlessedAvailability();
      const blessedEnabled = isAnalysisBlessedEnabled();
      const modeFallbackTargets = collectAutoModeFallbackTargets(start, target, refineMode);

      const aggregateMaterials = {};
      const missingLevelSet = new Set();
      const missingProtectionSet = new Set();
      let aggregateAttempts = 0;
      let aggregateZeny = 0;
      let aggregateLuck = 0;
      let successfulRuns = 0;
      let droppedRuns = 0;

      const baseSeed = buildAnalysisSeed(selection, start, target, refineMode, blessedEnabled);
      for (let runIndex = 0; runIndex < AUTO_ANALYSIS_RUNS; runIndex++) {
        const runSeed = (baseSeed + Math.imul(runIndex + 1, 2654435761)) >>> 0;
        const rng = createSeededRng(runSeed);
        const run = simulateAutoRun(selection, start, target, refineMode, blessedEnabled, rng);
        run.missingLevels.forEach((lv) => missingLevelSet.add(lv));
        run.missingProtectionLevels.forEach((lv) => missingProtectionSet.add(lv));

        if (!run.completed) {
          droppedRuns += 1;
          continue;
        }

        successfulRuns += 1;
        aggregateAttempts += Number(run.attempts ?? 0);
        aggregateZeny += Number(run.zeny ?? 0);
        aggregateLuck += Number(run.luck ?? 0);
        Object.values(run.materialMap || {}).forEach((mat) => mergeMaterialRowIntoMap(aggregateMaterials, mat));
      }

      if (successfulRuns <= 0) {
        costAnalysisState.mode = costMode;
        costAnalysisState.refineMode = refineMode;
        costAnalysisState.blessedEnabled = blessedEnabled;
        costAnalysisState.modeFallbackTargets = modeFallbackTargets;
        costAnalysisState.materials = [];
        costAnalysisState.totalZeny = 0;
        costAnalysisState.totalLuck = 0;
        costAnalysisState.expectedAttempts = 0;
        costAnalysisState.startLevel = start;
        costAnalysisState.targetLevel = target;
        costAnalysisState.simulationRuns = 0;
        costAnalysisState.droppedRuns = droppedRuns;
        costAnalysisState.missingLevels = Array.from(missingLevelSet).sort((a, b) => a - b);
        costAnalysisState.missingProtectionLevels = Array.from(missingProtectionSet).sort((a, b) => a - b);
        resultEl.innerHTML = '<div class="alert alert-warning py-2 mb-0 small">Auto Analys could not complete for this setup. Check refine mode/rate data for the selected range.</div>';
        return;
      }

      const averagedMaterials = materialMapToSortedArray(aggregateMaterials).map((mat) => ({
        ...mat,
        qty: Math.max(0, Math.ceil(Number(mat.qty ?? 0) / successfulRuns)),
      }));

      costAnalysisState.mode = costMode;
      costAnalysisState.refineMode = refineMode;
      costAnalysisState.blessedEnabled = blessedEnabled;
      costAnalysisState.modeFallbackTargets = modeFallbackTargets;
      costAnalysisState.materials = averagedMaterials;
      costAnalysisState.totalZeny = aggregateZeny / successfulRuns;
      costAnalysisState.totalLuck = aggregateLuck / successfulRuns;
      costAnalysisState.expectedAttempts = aggregateAttempts / successfulRuns;
      costAnalysisState.startLevel = start;
      costAnalysisState.targetLevel = target;
      costAnalysisState.simulationRuns = successfulRuns;
      costAnalysisState.droppedRuns = droppedRuns;
      costAnalysisState.missingLevels = Array.from(missingLevelSet).sort((a, b) => a - b);
      costAnalysisState.missingProtectionLevels = Array.from(missingProtectionSet).sort((a, b) => a - b);

      renderCostAnalysisResult();
      recalculateCostSummary();
    }

    function renderCostAnalysisResult() {
      const resultEl = document.getElementById("autoAnalysisResult");
      if (!resultEl) return;

      const mode = costAnalysisState.mode;
      const ownedColClass = mode === "crafting" ? "" : "d-none";
      const buyLabel = mode === "crafting" ? "Need Buy Qty" : "Buy Qty";
      const costLabel = mode === "crafting" ? "Need Buy Cost (Crystal)" : "Buy Cost (Crystal)";
      const materials = costAnalysisState.materials;

      const missingAlert = costAnalysisState.missingLevels.length > 0 ?
        `<div class="alert alert-warning py-2 mb-2 small">Missing cost rows for level(s): +${costAnalysisState.missingLevels.join(", +")}</div>` :
        "";
      const protectionAlert = (costAnalysisState.refineMode === Mode.SAFE && costAnalysisState.missingProtectionLevels.length > 0) ?
        `<div class="alert alert-warning py-2 mb-2 small">Protection stone data missing for level(s): +${costAnalysisState.missingProtectionLevels.join(", +")}</div>` :
        "";
      const droppedAlert = costAnalysisState.droppedRuns > 0 ?
        `<div class="alert alert-secondary py-2 mb-2 small">Some simulation runs were dropped (${formatInt(costAnalysisState.droppedRuns)}) because the run could not finish in time.</div>` :
        "";
      const fallbackTargets = Array.isArray(costAnalysisState.modeFallbackTargets) ? costAnalysisState.modeFallbackTargets : [];
      const fallbackPreview = fallbackTargets.slice(0, 10).map((lv) => `+${lv}`).join(", ");
      const fallbackTail = fallbackTargets.length > 10 ? ", ..." : "";
      const fallbackAlert = fallbackTargets.length > 0 ?
        `<div class="alert alert-info py-2 mb-2 small">Auto mode follows manual rules. Selected refine mode falls back to <b>normal</b> for target level(s): ${fallbackPreview}${fallbackTail}</div>` :
        "";

      let rowsHtml = "";
      if (materials.length === 0) {
        rowsHtml = '<tr><td colspan="6" class="text-body-secondary small">No material data available for this selection and level range.</td></tr>';
      } else {
        rowsHtml = materials.map((mat) => {
          const input = getMaterialInput(mat.id);
          const imageUrl = mat.image_file ? (ITEM_IMAGE_BASE_URL + mat.image_file) : DEFAULT_EQUIP_IMAGE_URL;
          return `
        <tr data-item-id="${mat.id}">
          <td>
            <div class="d-flex align-items-center gap-2">
              <img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(mat.name)}" width="22" height="22" style="object-fit:contain;" onerror="this.onerror=null;this.src='${escapeHtml(DEFAULT_EQUIP_IMAGE_URL)}'">
              <span>${escapeHtml(mat.name)}</span>
            </div>
          </td>
          <td class="text-end">${formatCount(mat.qty)}</td>
          <td>
            <input type="number" min="0" step="0.01" class="form-control form-control-sm js-price-input" data-item-id="${mat.id}" value="${escapeHtml(input.price)}" placeholder="0">
          </td>
          <td class="${ownedColClass}">
            <input type="number" min="0" step="1" class="form-control form-control-sm js-owned-input" data-item-id="${mat.id}" value="${escapeHtml(input.owned)}" placeholder="0">
          </td>
          <td class="text-end js-buy-qty" data-item-id="${mat.id}">0</td>
          <td class="text-end js-buy-cost" data-item-id="${mat.id}">0</td>
        </tr>
      `;
        }).join("");
      }

      resultEl.innerHTML = `
    ${missingAlert}
    ${protectionAlert}
    ${fallbackAlert}
    ${droppedAlert}
    <div class="small text-body-secondary mb-2">
      Analysis range: +${costAnalysisState.startLevel} -> +${costAnalysisState.targetLevel}
      <span class="ms-2">| Refine mode: <b>${escapeHtml(getAutoModeLabel(costAnalysisState.refineMode, costAnalysisState.blessedEnabled))}</b></span>
      <span class="ms-2">| Rate engine: <b>DB rate + pity</b></span>
      <span class="ms-2">| Successful runs: <b>${formatInt(costAnalysisState.simulationRuns)}</b> / ${formatInt(AUTO_ANALYSIS_RUNS)}</span>
    </div>
    <div class="table-responsive">
      <table class="table table-sm align-middle mb-2">
        <thead>
          <tr>
            <th>Material</th>
            <th class="text-end">Expected Required</th>
            <th>Price / Unit (Crystal)</th>
            <th class="${ownedColClass}">Owned</th>
            <th class="text-end" id="costBuyLabel">${buyLabel}</th>
            <th class="text-end" id="costBuyCostLabel">${costLabel}</th>
          </tr>
        </thead>
        <tbody>${rowsHtml}</tbody>
      </table>
    </div>
    <div class="row g-2 small">
      <div class="col-md-3 col-6"><div class="border rounded p-2">Expected Attempts<br><b id="costExpectedAttempts">0</b></div></div>
      <div class="col-md-3 col-6"><div class="border rounded p-2">Total Zeny Sink<br><b id="costTotalZeny">0</b></div></div>
      <div class="col-md-3 col-6"><div class="border rounded p-2">Total Luck Required<br><b id="costTotalLuck">0</b></div></div>
      <div class="col-md-3 col-6"><div class="border rounded p-2">Total ${buyLabel}<br><b id="costTotalBuyQty">0</b></div></div>
      <div class="col-md-3 col-6"><div class="border rounded p-2">Total ${costLabel}<br><b id="costTotalBuyCost">0</b></div></div>
      <div class="col-12"><div class="border rounded p-2">Currency Summary<br><b id="costCurrencySummary">Zeny: 0 | Crystal: 0</b></div></div>
    </div>
  `;
    }

    function recalculateCostSummary() {
      const mode = costAnalysisState.mode;
      let totalBuyQty = 0;
      let totalBuyCost = 0;

      costAnalysisState.materials.forEach((mat) => {
        const input = getMaterialInput(mat.id);
        const price = Math.max(0, Number.parseFloat(String(input.price || 0)) || 0);
        const owned = parseOwnedCount(input.owned);
        const required = Math.ceil(Number(mat.qty || 0));
        const buyQty = mode === "crafting" ? Math.max(0, required - owned) : required;
        const buyCost = buyQty * price;

        totalBuyQty += buyQty;
        totalBuyCost += buyCost;

        const buyQtyEl = document.querySelector(`.js-buy-qty[data-item-id="${mat.id}"]`);
        if (buyQtyEl) buyQtyEl.textContent = formatCount(buyQty);

        const buyCostEl = document.querySelector(`.js-buy-cost[data-item-id="${mat.id}"]`);
        if (buyCostEl) buyCostEl.textContent = formatMoney(buyCost);
      });

      const attempts = Number(costAnalysisState.expectedAttempts || 0);
      const zeny = Number(costAnalysisState.totalZeny || 0);
      const luck = Number(costAnalysisState.totalLuck || 0);

      const expectedAttemptsEl = document.getElementById("costExpectedAttempts");
      if (expectedAttemptsEl) expectedAttemptsEl.textContent = formatQty(attempts);

      const totalZenyEl = document.getElementById("costTotalZeny");
      if (totalZenyEl) totalZenyEl.textContent = formatMoney(zeny);

      const totalLuckEl = document.getElementById("costTotalLuck");
      if (totalLuckEl) totalLuckEl.textContent = formatMoney(luck);

      const totalBuyQtyEl = document.getElementById("costTotalBuyQty");
      if (totalBuyQtyEl) totalBuyQtyEl.textContent = formatCount(totalBuyQty);

      const totalBuyCostEl = document.getElementById("costTotalBuyCost");
      if (totalBuyCostEl) totalBuyCostEl.textContent = formatMoney(totalBuyCost);

      const summaryEl = document.getElementById("costCurrencySummary");
      if (summaryEl) summaryEl.textContent = `Zeny: ${formatMoney(zeny)} | Crystal: ${formatMoney(totalBuyCost)}`;
    }

    function getModeLabel(mode) {
      if (mode === Mode.SAFE) return "safe";
      if (mode === Mode.PREMIUM) return "premium";
      return "normal";
    }

    function getAutoModeLabel(mode, blessedEnabled) {
      const base = getModeLabel(mode);
      if (blessedEnabled && mode !== Mode.PREMIUM) {
        return `${base} + blessed`;
      }
      return base;
    }

    function mergeMaterialRowIntoMap(materialMap, mat) {
      const itemId = Number(mat?.id ?? 0);
      const qty = Number(mat?.qty ?? 0);
      if (itemId <= 0 || qty <= 0) return;

      if (!materialMap[itemId]) {
        materialMap[itemId] = {
          id: itemId,
          name: normalizeMaterialName(mat?.name),
          image_file: mat?.image_file ? String(mat.image_file) : null,
          qty: 0,
        };
      }
      if (!materialMap[itemId].name) {
        materialMap[itemId].name = "Unknown Material";
      }
      materialMap[itemId].qty += qty;
    }

    function materialMapToSortedArray(materialMap) {
      return Object.values(materialMap || {}).sort((a, b) => String(a.name || "").localeCompare(String(b.name || "")));
    }

    function getAttemptCostData(selection, targetLevel, mode) {
      const base = getCostLevelData(selection, targetLevel);
      if (!base) return null;

      const materialMap = {};
      mergeMaterialRowIntoMap(materialMap, base.normal_material);
      mergeMaterialRowIntoMap(materialMap, base.special_material);

      if (mode === Mode.SAFE && targetLevel >= 5) {
        const protection = getProtectionLevelData(selection, targetLevel);
        mergeMaterialRowIntoMap(materialMap, protection);
      }

      return {
        zeny: Number(base.zeny ?? 0),
        luck: Number(base.luck ?? 0),
        materials: materialMapToSortedArray(materialMap),
      };
    }

    function renderCompactMaterials(materials, emptyText) {
      const list = Array.isArray(materials) ? materials : [];
      if (list.length === 0) {
        return `<span class="text-body-secondary">${escapeHtml(emptyText)}</span>`;
      }

      return `<div class="d-flex flex-wrap gap-1">` + list.map((mat) => {
        const imageUrl = mat.image_file ? (ITEM_IMAGE_BASE_URL + mat.image_file) : DEFAULT_EQUIP_IMAGE_URL;
        return `
      <span class="border rounded px-2 py-1 d-inline-flex align-items-center gap-1">
        <img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(mat.name)}" width="14" height="14" style="object-fit:contain;" onerror="this.onerror=null;this.src='${escapeHtml(DEFAULT_EQUIP_IMAGE_URL)}'">
        <span>${escapeHtml(mat.name)} x${formatInt(mat.qty)}</span>
      </span>
    `;
      }).join("") + `</div>`;
    }

    function renderManualMaterialPricingRows() {
      const container = document.getElementById("manualMaterialPricingRows");
      if (!container) return;

      const selection = getEquipSelection();
      if (!selection) {
        container.innerHTML = '<span class="text-body-secondary">Select equipment type/subtype and rarity first.</span>';
        return;
      }

      const mode = getManualCostMode();
      const showOwned = mode === "crafting";
      const ownedClass = showOwned ? "" : "d-none";
      const buyQtyLabel = showOwned ? "Need Buy Qty" : "Buy Qty";
      const buyCostLabel = showOwned ? "Need Buy Cost (Crystal)" : "Buy Cost (Crystal)";
      const materials = manualPricingState.catalogMaterials;

      if (materials.length === 0) {
        container.innerHTML = '<span class="text-body-secondary">No material rows found for this equipment selection.</span>';
        return;
      }

      const rowsHtml = materials.map((mat) => {
        const input = getManualMaterialInput(mat.id);
        const sessionQty = getManualSessionQtyByItemId(mat.id);
        const imageUrl = mat.image_file ? (ITEM_IMAGE_BASE_URL + mat.image_file) : DEFAULT_EQUIP_IMAGE_URL;
        return `
      <tr data-item-id="${mat.id}">
        <td>
          <div class="d-flex align-items-center gap-2">
            <img src="${escapeHtml(imageUrl)}" alt="${escapeHtml(mat.name)}" width="18" height="18" style="object-fit:contain;" onerror="this.onerror=null;this.src='${escapeHtml(DEFAULT_EQUIP_IMAGE_URL)}'">
            <span>${escapeHtml(mat.name)}</span>
          </div>
        </td>
        <td class="text-end">${formatCount(sessionQty)}</td>
        <td>
          <input type="number" min="0" step="0.01" class="form-control form-control-sm js-manual-price-input" data-item-id="${mat.id}" value="${escapeHtml(input.price)}" placeholder="0">
        </td>
        <td class="${ownedClass}">
          <input type="number" min="0" step="1" class="form-control form-control-sm js-manual-owned-input" data-item-id="${mat.id}" value="${escapeHtml(input.owned)}" placeholder="0">
        </td>
        <td class="text-end js-manual-buy-qty" data-item-id="${mat.id}">0</td>
        <td class="text-end js-manual-buy-cost" data-item-id="${mat.id}">0</td>
      </tr>
    `;
      }).join("");

      container.innerHTML = `
    <div class="table-responsive">
      <table class="table table-sm align-middle mb-0">
        <thead>
          <tr>
            <th>Material</th>
            <th class="text-end">Session Used Qty</th>
            <th>Price / Unit (Crystal)</th>
            <th class="${ownedClass}">Owned</th>
            <th class="text-end">${buyQtyLabel}</th>
            <th class="text-end">${buyCostLabel}</th>
          </tr>
        </thead>
        <tbody>${rowsHtml}</tbody>
      </table>
    </div>
  `;
    }

    function updateManualPricingCatalog() {
      const selection = getEquipSelection();
      if (!selection) {
        manualPricingState.catalogMaterials = [];
        renderManualMaterialPricingRows();
        recalculateManualCostSummary();
        return;
      }

      manualPricingState.catalogMaterials = collectManualCatalogMaterials(selection);
      renderManualMaterialPricingRows();
      recalculateManualCostSummary();
    }

    function recalculateManualCostSummary() {
      const mode = getManualCostMode();
      const sessionMaterials = materialMapToSortedArray(manualCostState.totalMaterials);
      const pricingMaterials = manualPricingState.catalogMaterials;
      const lastMaterials = (manualCostState.lastAttempt && !manualCostState.lastAttempt.missing) ?
        (manualCostState.lastAttempt.materials || []) :
        [];

      pricingMaterials.forEach((mat) => {
        const input = getManualMaterialInput(mat.id);
        const price = Math.max(0, Number.parseFloat(String(input.price || 0)) || 0);
        const owned = parseOwnedCount(input.owned);
        const required = Math.ceil(getManualSessionQtyByItemId(mat.id));
        const buyQty = mode === "crafting" ? Math.max(0, required - owned) : required;
        const buyCost = buyQty * price;

        const qtyEl = document.querySelector(`.js-manual-buy-qty[data-item-id="${mat.id}"]`);
        if (qtyEl) qtyEl.textContent = formatCount(buyQty);

        const costEl = document.querySelector(`.js-manual-buy-cost[data-item-id="${mat.id}"]`);
        if (costEl) costEl.textContent = formatMoney(buyCost);
      });

      const lastCrystal = computeCrystalTotalsFromMaterials(lastMaterials, mode, getManualMaterialInput);
      const sessionCrystal = computeCrystalTotalsFromMaterials(sessionMaterials, mode, getManualMaterialInput);
      const sessionZeny = Number(manualCostState.totalZeny ?? 0);

      const lastCrystalEl = document.getElementById("manualCostLastCrystal");
      if (lastCrystalEl) lastCrystalEl.textContent = formatMoney(lastCrystal.totalBuyCost);

      const lastBuyQtyEl = document.getElementById("manualCostLastBuyQty");
      if (lastBuyQtyEl) lastBuyQtyEl.textContent = formatCount(lastCrystal.totalBuyQty);

      const sessionCrystalEl = document.getElementById("manualCostSessionCrystal");
      if (sessionCrystalEl) sessionCrystalEl.textContent = formatMoney(sessionCrystal.totalBuyCost);

      const sessionBuyQtyEl = document.getElementById("manualCostSessionBuyQty");
      if (sessionBuyQtyEl) sessionBuyQtyEl.textContent = formatCount(sessionCrystal.totalBuyQty);

      const summaryEl = document.getElementById("manualCostCurrencySummary");
      if (summaryEl) {
        summaryEl.textContent = `Zeny: ${formatInt(sessionZeny)} | Crystal: ${formatMoney(sessionCrystal.totalBuyCost)}`;
      }
    }

    function updateManualCostUI() {
      const lastMetaEl = document.getElementById("manualCostLastMeta");
      const lastZenyEl = document.getElementById("manualCostLastZeny");
      const lastLuckEl = document.getElementById("manualCostLastLuck");
      const lastMaterialsEl = document.getElementById("manualCostLastMaterials");
      const sessionAttemptsEl = document.getElementById("manualCostSessionAttempts");
      const sessionZenyEl = document.getElementById("manualCostSessionZeny");
      const sessionLuckEl = document.getElementById("manualCostSessionLuck");
      const sessionMaterialsEl = document.getElementById("manualCostSessionMaterials");

      if (!lastMetaEl || !lastZenyEl || !lastLuckEl || !lastMaterialsEl || !sessionAttemptsEl || !sessionZenyEl || !sessionLuckEl || !sessionMaterialsEl) {
        return;
      }

      const last = manualCostState.lastAttempt;
      if (!last) {
        lastMetaEl.textContent = "No refine attempts yet.";
        lastZenyEl.textContent = "0";
        lastLuckEl.textContent = "0";
        lastMaterialsEl.innerHTML = '<span class="text-body-secondary">-</span>';
      } else if (last.missing) {
        lastMetaEl.textContent = `Cost data unavailable for target +${last.target} (${getModeLabel(last.mode)}).`;
        lastZenyEl.textContent = "0";
        lastLuckEl.textContent = "0";
        lastMaterialsEl.innerHTML = '<span class="text-body-secondary">No material data.</span>';
      } else {
        lastMetaEl.textContent = `Target +${last.target} | Mode: ${getModeLabel(last.mode)}`;
        lastZenyEl.textContent = formatInt(last.zeny);
        lastLuckEl.textContent = formatInt(last.luck);
        lastMaterialsEl.innerHTML = renderCompactMaterials(last.materials, "No materials");
      }

      sessionAttemptsEl.textContent = formatInt(manualCostState.attempts);
      sessionZenyEl.textContent = formatInt(manualCostState.totalZeny);
      sessionLuckEl.textContent = formatInt(manualCostState.totalLuck);
      sessionMaterialsEl.innerHTML = renderCompactMaterials(
        materialMapToSortedArray(manualCostState.totalMaterials),
        "No materials consumed yet."
      );

      renderManualMaterialPricingRows();
      recalculateManualCostSummary();
    }

    function addManualAttemptCost(selection, targetLevel, mode) {
      const attemptCost = getAttemptCostData(selection, targetLevel, mode);
      if (!attemptCost) {
        manualCostState.lastAttempt = {
          target: targetLevel,
          mode,
          missing: true,
          zeny: 0,
          luck: 0,
          materials: [],
        };
        updateManualCostUI();
        return;
      }

      manualCostState.attempts += 1;
      manualCostState.totalZeny += Number(attemptCost.zeny ?? 0);
      manualCostState.totalLuck += Number(attemptCost.luck ?? 0);
      attemptCost.materials.forEach((mat) => mergeMaterialRowIntoMap(manualCostState.totalMaterials, mat));

      manualCostState.lastAttempt = {
        target: targetLevel,
        mode,
        missing: false,
        zeny: Number(attemptCost.zeny ?? 0),
        luck: Number(attemptCost.luck ?? 0),
        materials: attemptCost.materials,
      };

      updateManualCostUI();
    }

    function resetManualCostState() {
      manualCostState.attempts = 0;
      manualCostState.totalZeny = 0;
      manualCostState.totalLuck = 0;
      manualCostState.totalMaterials = {};
      manualCostState.lastAttempt = null;
      updateManualCostUI();
    }

    /** ========= STATE ========= */
    const state = {
      level: 0,
      isBroken: false,
      pity: {}, // pity[targetLevel] = points
      totalAttempts: 0,
      totalFails: 0,
      totalBreaks: 0
    };

    function getPity(target) {
      return state.pity[target] ?? 0;
    }

    function setPity(target, v) {
      state.pity[target] = Math.max(0, Math.min(PITY_REQUIRED, v));
    }

    function pityGuaranteed(target) {
      return getPity(target) >= PITY_REQUIRED;
    }

    function getPityGain(target, mode, currentPoints) {
      const row = PITY_POINTS[target];
      if (!row) return 0;
      const idx = pityStageIdx(currentPoints);
      if (mode === Mode.SAFE) return (row.safe?.[idx] ?? 0);
      return (row.normal?.[idx] ?? 0);
    }

    /** ========= SELECTION GATE (same spirit as before) ========= */
    function getEquipSelection() {
      const equipmentType = document.getElementById("equipmentType")?.value ?? "";
      const weaponType = document.getElementById("weaponType")?.value ?? "";
      const decorationType = document.getElementById("decorationType")?.value ?? "";
      const rarity = document.getElementById("raritySelect")?.value ?? "";
      if (!equipmentType || !rarity) return null;
      if (equipmentType === "Weapon" && !weaponType) return null;
      if (equipmentType === "Decoration" && !decorationType) return null;
      return {
        equipmentType,
        weaponType,
        decorationType,
        rarity,
        quality: getQualityFromRarity(rarity)
      };
    }

    /** ========= BLESSING TIER RULES (by current level) ========= */
    function canUseBlessingTier1(level) {
      return level >= 4 && level <= 7;
    } // +4 -> +5 ... +7 -> +8
    function canUseBlessingTier2(level) {
      return level >= 8 && level <= 11;
    } // +8 -> +9 ... +11 -> +12

    /** ========= STONE UI LOCKING (restored order) ========= */
    function handleStoneSelection() {
      const blessed = document.getElementById("blessedStone");
      const protection = document.getElementById("protectionStone");
      const blessing = document.getElementById("blessingStone");

      // 1) show/hide by level (same as previous)
      const show = state.level >= 4;
      document.getElementById("blessedStoneWrapper").style.display = show ? "block" : "none";
      document.getElementById("protectionStoneWrapper").style.display = show ? "block" : "none";
      document.getElementById("blessingStoneWrapper").style.display = show ? "block" : "none";

      if (!show) {
        blessed.checked = false;
        protection.checked = false;
        blessing.checked = false;
      }

      // 2) validate blessing by tier rule (current level)
      if (blessing.checked) {
        const ok = canUseBlessingTier1(state.level) || canUseBlessingTier2(state.level);
        if (!ok) {
          blessing.checked = false;
          document.getElementById("resultMessage").innerText = "Blessing Stone cannot be used at this level.";
        }
      }

      // 3) mutual exclusion (same behavior)
      if (blessing.checked) {
        blessed.disabled = true;
        protection.disabled = true;
      } else {
        blessed.disabled = false;
        protection.disabled = false;
      }

      if (blessed.checked || protection.checked) {
        blessing.disabled = true;
      } else {
        blessing.disabled = false;
      }
    }

    /** ========= MODE RESOLUTION (same behavior mapping) ========= */
    function getMode() {
      const protection = document.getElementById("protectionStone")?.checked;
      const blessing = document.getElementById("blessingStone")?.checked;

      if (blessing) return Mode.PREMIUM;
      if (protection) return Mode.SAFE;
      return Mode.NONE;
    }

    /** ========= PROBABILITY (same as before, with hard gate for <5) ========= */
    function getOutcomeProb(target, mode, quality) {
      // Hard gate: break/downgrade only from target >= 5
      const allowRisk = target >= 5;

      if (mode === Mode.SAFE) {
        const r = getSafeRate(quality, target);
        if (!r) return null;
        return {
          s: r.s,
          f: r.f,
          d: 0,
          b: allowRisk ? r.b : 0
        };
      }

      const r = getRegularRate(quality, target);
      if (!r) return null;

      if (mode === Mode.PREMIUM) {
        // Premium: no break/no downgrade; fail absorbs them
        return {
          s: r.s,
          f: (r.f + r.d + r.b),
          d: 0,
          b: 0
        };
      }

      return {
        s: r.s,
        f: r.f,
        d: allowRisk ? r.d : 0,
        b: allowRisk ? r.b : 0
      };
    }

    function rollOutcome(prob, rngFn) {
      const x = typeof rngFn === "function" ? rngFn() : Math.random();
      const a = prob.s;
      const b = a + prob.f;
      const c = b + prob.d;
      if (x < a) return "success";
      if (x < b) return "fail";
      if (x < c) return "downgrade";
      return "break";
    }

    /** ========= UI ========= */
    function updateUI() {
      document.getElementById("refineLevel").innerText = state.level;

      const failedRate = (state.totalFails / Math.max(1, state.totalAttempts)) * 100;
      const breakRate = (state.totalBreaks / Math.max(1, state.totalAttempts)) * 100;
      document.getElementById("failedRate").innerText = failedRate.toFixed(2) + "%";
      document.getElementById("breakRate").innerText = breakRate.toFixed(2) + "%";

      const target = Math.min(15, state.level + 1);
      const pts = getPity(target);
      document.getElementById("pityPointsText").innerText = pts;
      document.getElementById("pityStageText").innerText = pityStage(pts);
      document.getElementById("pityBar").style.width = ((pts / PITY_REQUIRED) * 100).toFixed(2) + "%";

      document.getElementById("brokenPanel").style.display = state.isBroken ? "block" : "none";
    }

    /** ========= MAIN REFINE (behavior preserved) ========= */
    function refineItem() {
      const sel = getEquipSelection();
      const msgEl = document.getElementById("resultMessage");

      if (!sel) {
        msgEl.innerText = "Select equipment type/subtype and rarity first.";
        return;
      }
      if (state.isBroken) {
        msgEl.innerText = "Equipment is broken. Repair/Transfer to continue.";
        return;
      }
      if (state.level >= 15) {
        msgEl.innerText = "Max refine level reached!";
        return;
      }

      state.totalAttempts++;

      const target = state.level + 1;
      const quality = sel.quality ?? 1;
      const mode = getMode();
      const blessedChecked = document.getElementById("blessedStone")?.checked;
      addManualAttemptCost(sel, target, mode);

      // Level 0-3 (target 1-4): fail-only (no break/dg), same as old feel
      if (target <= 4) {
        const sr = getRegularRate(quality, target)?.s ?? 0;
        if (Math.random() < sr) {
          state.level = target;
          setPity(target, 0);
          msgEl.innerText = `Success! Refine level increased to ${state.level}.`;
        } else {
          state.totalFails++;
          // pity still works from early levels (as you said pity active from +0)
          const cur = getPity(target);
          const gain = getPityGain(target, mode, cur);
          setPity(target, cur + gain);
          msgEl.innerText = "Failed! Refine level remains the same.";
        }
        updateUI();
        handleStoneSelection();
        return;
      }

      // Pity guarantee check (before RNG)
      if (pityGuaranteed(target)) {
        state.level = target;
        setPity(target, 0);
        msgEl.innerText = `Guaranteed Success! Refine level increased to ${state.level}.`;
        updateUI();
        handleStoneSelection();
        return;
      }

      const prob = getOutcomeProb(target, mode, quality);
      if (!prob) {
        msgEl.innerText = "Rate table missing for this target level.";
        return;
      }

      // Blessed: anti-break only (break -> fail), downgrade remains possible
      let finalProb = {
        ...prob
      };
      if (mode !== Mode.PREMIUM && blessedChecked) {
        finalProb.f += finalProb.b;
        finalProb.b = 0;
      }

      let outcome = rollOutcome(finalProb);

      // Absolute safety: no break/dg under target<5 (extra guard)
      if (target < 5 && (outcome === "break" || outcome === "downgrade")) outcome = "fail";

      // Pity add/reset
      if (outcome !== "success") {
        const cur = getPity(target);
        const gain = getPityGain(target, mode, cur);
        setPity(target, cur + gain);
      } else {
        setPity(target, 0);
      }

      // Apply outcome (same rules)
      if (outcome === "success") {
        state.level = target;
        msgEl.innerText = `Success! Refine level increased to ${state.level}.`;
      } else if (outcome === "fail") {
        state.totalFails++;
        msgEl.innerText = "Failed! Refine level remains the same.";
      } else if (outcome === "downgrade") {
        state.totalFails++;
        state.level = Math.max(3, state.level - 1); // cannot go below +3
        msgEl.innerText = `Failed! Refine level downgraded to ${state.level}.`;
      } else if (outcome === "break") {
        state.totalBreaks++;
        state.isBroken = true; // broken blocks further refine until repaired/transferred
        msgEl.innerText = "Equipment BROKE! Repair/Transfer required to continue.";
      }

      updateUI();
      handleStoneSelection();
    }

    function resetSim() {
      state.level = 0;
      state.isBroken = false;
      state.pity = {};
      state.totalAttempts = 0;
      state.totalFails = 0;
      state.totalBreaks = 0;

      document.getElementById("resultMessage").innerText = "";

      const bs = document.getElementById("blessedStone");
      const ps = document.getElementById("protectionStone");
      const ls = document.getElementById("blessingStone");
      if (bs) bs.checked = false;
      if (ps) ps.checked = false;
      if (ls) ls.checked = false;

      resetManualCostState();
      handleStoneSelection();
      updateUI();
    }

    /** ========= DROPDOWN LOGIC (restored clean & deterministic) ========= */
    function setRarityOptions(selectId, list) {
      const sel = document.getElementById(selectId);
      if (!sel) return;
      sel.innerHTML = `<option value="">Select Rarity</option>` + list.map((x) => `<option value="${x}">${x}</option>`).join("");
    }

    document.addEventListener("DOMContentLoaded", function() {
      const equipmentType = document.getElementById("equipmentType");
      const weaponTypeWrapper = document.getElementById("weaponTypeWrapper");
      const weaponType = document.getElementById("weaponType");
      const decorationTypeWrapper = document.getElementById("decorationTypeWrapper");
      const decorationType = document.getElementById("decorationType");
      const rarityWrapper = document.getElementById("rarityWrapper");
      const raritySelect = document.getElementById("raritySelect");

      const manualCostMode = document.getElementById("manualCostMode");
      const manualMaterialPricingRows = document.getElementById("manualMaterialPricingRows");

      equipmentType?.addEventListener("change", () => {
        if (weaponTypeWrapper) weaponTypeWrapper.style.display = "none";
        if (decorationTypeWrapper) decorationTypeWrapper.style.display = "none";
        if (rarityWrapper) rarityWrapper.style.display = "none";
        if (weaponType) weaponType.value = "";
        if (decorationType) decorationType.value = "";
        if (raritySelect) raritySelect.value = "";
        setRarityOptions("raritySelect", []);

        if (equipmentType.value === "Weapon") {
          if (weaponTypeWrapper) weaponTypeWrapper.style.display = "block";
        } else if (equipmentType.value === "Armor") {
          if (rarityWrapper) rarityWrapper.style.display = "block";
          setRarityOptions("raritySelect", getAvailableRarities("Armor", "", ""));
        } else if (equipmentType.value === "Decoration") {
          if (decorationTypeWrapper) decorationTypeWrapper.style.display = "block";
        }

        updateEquipmentPreviewImage();
        updateManualPricingCatalog();
      });

      weaponType?.addEventListener("change", () => {
        if (!rarityWrapper || !raritySelect) return;
        rarityWrapper.style.display = weaponType.value ? "block" : "none";
        raritySelect.value = "";
        if (weaponType.value) {
          setRarityOptions("raritySelect", getAvailableRarities("Weapon", weaponType.value, ""));
        } else {
          setRarityOptions("raritySelect", []);
        }
        updateEquipmentPreviewImage();
        updateManualPricingCatalog();
      });

      decorationType?.addEventListener("change", () => {
        if (!rarityWrapper || !raritySelect) return;
        rarityWrapper.style.display = decorationType.value ? "block" : "none";
        raritySelect.value = "";
        setRarityOptions("raritySelect", getAvailableRarities("Decoration", "", decorationType.value));
        updateEquipmentPreviewImage();
        updateManualPricingCatalog();
      });

      raritySelect?.addEventListener("change", () => {
        updateEquipmentPreviewImage();
        updateManualPricingCatalog();
      });

      manualCostMode?.addEventListener("change", () => {
        renderManualMaterialPricingRows();
        recalculateManualCostSummary();
      });

      manualMaterialPricingRows?.addEventListener("input", (event) => {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) return;
        const itemId = target.dataset.itemId;
        if (!itemId) return;

        const input = getManualMaterialInput(itemId);
        if (target.classList.contains("js-manual-price-input")) {
          input.price = target.value;
        } else if (target.classList.contains("js-manual-owned-input")) {
          input.owned = target.value;
        } else {
          return;
        }

        recalculateManualCostSummary();
      });

      document.getElementById("btnRepair")?.addEventListener("click", () => {
        state.isBroken = false;
        document.getElementById("resultMessage").innerText = "Repaired. You can refine again.";
        updateUI();
      });

      document.getElementById("btnTransfer")?.addEventListener("click", () => {
        state.isBroken = false;
        document.getElementById("resultMessage").innerText = "Transferred. You can refine again.";
        updateUI();
      });

      handleStoneSelection();
      updateEquipmentPreviewImage();
      resetManualCostState();
      updateManualPricingCatalog();
      updateUI();

      // keep inline onclick safe
      window.refineItem = refineItem;
      window.resetSim = resetSim;
      window.handleStoneSelection = handleStoneSelection;
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
