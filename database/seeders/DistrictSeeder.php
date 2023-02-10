<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caboDelgado = Province::where('cod', 'CD')->first();

        $ancuabe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Ancuabe',
            'cod' => 'CB-ACB',
        ]);

        $balama = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Balama',
            'cod' => 'CB-BLM',
        ]);

        $chiure = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chiúre',
            'cod' => 'CB-CHR',
        ]);

        $ibo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Ibo',
            'cod' => 'CB-IBO',
        ]);

        $macomia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Macomia',
            'cod' => 'CB-MCM',
        ]);

        $mecufi = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mecúfi',
            'cod' => 'CB-MCF',
        ]);

        $meluco = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Meluco',
            'cod' => 'CB-MLC',
        ]);

        $metuge = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Metuge',
            'cod' => 'CB-MTG',
        ]);

        $mocimboaDaPraia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mocímboa da Praia',
            'cod' => 'CB-MDP',
        ]);

        $montepuez = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Montepuez',
            'cod' => 'CB-MTP',
        ]);

        $mueda = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mueda',
            'cod' => 'CB-MUD',
        ]);

        $muidumbe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Muidumbe',
            'cod' => 'CB-MDB',
        ]);

        $namuno = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Namuno',
            'cod' => 'CB-NMN',
        ]);

        $nangade = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nangade',
            'cod' => 'CB-NGD',
        ]);

        $palma = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Palma',
            'cod' => 'CB-PLM',
        ]);

        $pemba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Pemba',
            'cod' => 'CB-PMB',
        ]);

        $quissanga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Quissanga',
            'cod' => 'CB-QSG',
        ]);

        $caboDelgado->districts()->saveMany([$ancuabe, $balama, $chiure, $ibo, $macomia, $mecufi, $meluco, $metuge, $mocimboaDaPraia, $montepuez, $mueda, $muidumbe, $namuno, $nangade,  $palma, $pemba, $quissanga]);

        $gaza = Province::where('cod', 'GZ')->first();

        $bilene = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Bilene',
            'cod' => 'GZ-BLN',
        ]);

        $chibuto = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chibuto',
            'cod' => 'GZ-CBT',
        ]);

        $chicualacuala = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chicualacuala',
            'cod' => 'GZ-CCL',
        ]);

        $chigubo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chigubo',
            'cod' => 'GZ-CGB',
        ]);

        $chokwe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chókwè',
            'cod' => 'GZ-CKW',
        ]);

        $chongoene = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chongoene',
            'cod' => 'GZ-CGN',
        ]);

        $guija = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Guijá',
            'cod' => 'GZ-GJA',
        ]);

        $limpompo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Limpopo',
            'cod' => 'GZ-LPP',
        ]);

        $mabalane = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mabalane',
            'cod' => 'GZ-MBL',
        ]);

        $manjacaze = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Manjacaze',
            'cod' => 'GZ-MJZ',
        ]);

        $mapai = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mapai',
            'cod' => 'GZ-MPI',
        ]);

        $massangena = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Massangena',
            'cod' => 'GZ-MSN',
        ]);

        $massingir = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Massingir',
            'cod' => 'GZ-MSG',
        ]);

        $xaiXai = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Xai-Xai',
            'cod' => 'GZ-XAI',
        ]);

        $gaza->districts()->saveMany([$bilene, $chibuto, $chicualacuala, $chigubo, $chokwe, $chongoene, $guija, $limpompo, $mabalane, $manjacaze, $mapai, $massangena, $massingir, $xaiXai]);

        $inhambane = Province::where('cod', 'IB')->first();

        $funhalouro = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Funhalouro',
            'cod' => 'IB-FNL',
        ]);

        $govuro = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Govuro',
            'cod' => 'IB-GVR',
        ]);

        $homoine = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Homoíne',
            'cod' => 'IB-HMN',
        ]);

        $inhambaneDistrict = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Inhambane',
            'cod' => 'IB-IBN',
        ]);

        $inharrime = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Inharrime',
            'cod' => 'IB-INR',
        ]);

        $inhassoro = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Inhassoro',
            'cod' => 'IB-INS',
        ]);

        $jangamo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Jangamo',
            'cod' => 'IB-JGM',
        ]);

        $mabote = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mabote',
            'cod' => 'IB-MBT',
        ]);

        $massinga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Massinga',
            'cod' => 'IB-MSG',
        ]);

        $maxixe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Maxixe',
            'cod' => 'IB-MXX',
        ]);

        $morrumbene = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Morrumbene',
            'cod' => 'IB-MRB',
        ]);

        $panda = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Panda',
            'cod' => 'IB-PND',
        ]);

        $vilanculos = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Vilanculos',
            'cod' => 'IB-VLC',
        ]);

        $zavala = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Zavala',
            'cod' => 'IB-ZVL',
        ]);

        $inhambane->districts()->saveMany([$funhalouro, $govuro, $homoine, $inhambaneDistrict, $inharrime, $inhassoro, $jangamo, $mabote, $massinga, $maxixe, $morrumbene, $panda, $vilanculos, $zavala]);

        // MANICA
        $manica = Province::where('cod', 'MN')->first();

        $barue = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Bárue',
            'cod' => 'MN-BRE',
        ]);

        $chimoio = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chimoio',
            'cod' => 'MN-CHM',
        ]);

        $gondola = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Gondola',
            'cod' => 'MN-GDL',
        ]);

        $guro = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Guro',
            'cod' => 'MN-GRO',
        ]);

        $macate = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Macate',
            'cod' => 'MN-MCT',
        ]);

        $machaze = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Machaze',
            'cod' => 'MN-MCZ',
        ]);

        $macossa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Macossa',
            'cod' => 'MN-MCS',
        ]);

        $manicaDistrict = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Manica',
            'cod' => 'MN-MNC',
        ]);

        $mossurize = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mossurize',
            'cod' => 'MN-MSR',
        ]);

        $sussundenga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Sussundenga',
            'cod' => 'MN-SSD',
        ]);

        $tambara = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Tambara',
            'cod' => 'MN-TBR',
        ]);

        $vanduzi = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Vanduzi',
            'cod' => 'MN-VDZ',
        ]);

        $manica->districts()->saveMany([$barue, $chimoio, $gondola, $guro, $macate, $machaze, $macossa, $manicaDistrict, $mossurize, $sussundenga, $tambara, $vanduzi]);

        // Maputo
        $maputo = Province::where('cod', 'MP')->first();

        $boane = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Boane',
            'cod' => 'MP-BON',
        ]);

        $magude = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Magude',
            'cod' => 'MP-MGD',
        ]);

        $manhica = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Manhiça',
            'cod' => 'MP-MNC',
        ]);

        $marracuene = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Marracuene',
            'cod' => 'MP-MRC',
        ]);

        $matola = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Matola',
            'cod' => 'MP-MTL',
        ]);

        $matutuine = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Matutuíne',
            'cod' => 'MP-MTT',
        ]);

        $moamba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Moamba',
            'cod' => 'MP-MMB',
        ]);

        $namaacha = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Namaacha',
            'cod' => 'MP-NMC',
        ]);

        $maputo->districts()->saveMany([$boane, $magude, $manhica, $marracuene, $matola, $matutuine, $moamba, $namaacha]);

        // Nampula

        $nampula = Province::where('cod', 'NP')->first();

        $angoche = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Angoche',
            'cod' => 'NP-AGC',
        ]);

        $erati = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Eráti',
            'cod' => 'NP-ERT',
        ]);

        $ilhaDeMocambique = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Ilha de Moçambique',
            'cod' => 'NP-IDM',
        ]);

        $lalaua = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Lalaua',
            'cod' => 'NP-LLA',
        ]);

        $larde = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Larde',
            'cod' => 'NP-LRD',
        ]);

        $liupo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Liúpo',
            'cod' => 'NP-LIP',
        ]);

        $malema = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Malema',
            'cod' => 'NP-MLM',
        ]);

        $meconta = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Meconta',
            'cod' => 'NP-MCT',
        ]);

        $mecuburi = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mecubúri',
            'cod' => 'NP-MCB',
        ]);

        $memba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Memba',
            'cod' => 'NP-MBA',
        ]);

        $mongicual = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mogincual',
            'cod' => 'NP-MGC',
        ]);

        $mogovolas = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mogovolas',
            'cod' => 'NP-MGV',
        ]);

        $mogovolas = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mogovolas',
            'cod' => 'NP-MGV',
        ]);

        $moma = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Moma',
            'cod' => 'NP-MOM',
        ]);

        $monapo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Monapo',
            'cod' => 'NP-MNP',
        ]);

        $mossuril = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mossuril',
            'cod' => 'NP-MSR',
        ]);

        $muecate = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Muecate',
            'cod' => 'NP-MUC',
        ]);

        $murrupula = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Murrupula',
            'cod' => 'NP-MRP',
        ]);

        $nacalaAVelha = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nacala-a-Velha',
            'cod' => 'NP-NAV',
        ]);

        $nacalaPorto = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nacala Porto',
            'cod' => 'NP-NAP',
        ]);

        $nacaroa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nacarôa',
            'cod' => 'NP-NCR',
        ]);

        $nampulaDistrict = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nampula',
            'cod' => 'NP-NPL',
        ]);

        $rapale = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Rapale',
            'cod' => 'NP-RPL',
        ]);

        $ribaue = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Ribaué',
            'cod' => 'NP-RBE',
        ]);

        $nampula->districts()->saveMany([$angoche, $erati, $ilhaDeMocambique, $lalaua, $larde, $liupo, $malema, $meconta, $mecuburi, $memba, $mongicual, $mogovolas, $moma, $monapo, $mossuril, $muecate, $nacalaAVelha, $nacalaPorto, $nacaroa, $nampulaDistrict, $rapale, $ribaue]);

        // Niassa
        $niassa = Province::where('cod', 'NS')->first();

        $chimbonila = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chimbonila',
            'cod' => 'NS-CBN',
        ]);

        $cuamba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Cuamba',
            'cod' => 'NS-CMB',
        ]);

        $lago = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Lago',
            'cod' => 'NS-LGO',
        ]);

        $lichinga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Lichinga',
            'cod' => 'NS-LCG',
        ]);

        $majune = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Majune',
            'cod' => 'NS-MJN',
        ]);

        $mandimba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mandimba',
            'cod' => 'NS-MDB',
        ]);

        $marrupa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Marrupa',
            'cod' => 'NS-MRP',
        ]);

        $maua = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Maúa',
            'cod' => 'NS-MAU',
        ]);

        $mavago = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mavago',
            'cod' => 'NS-MVG',
        ]);

        $mecanhelas = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mecanhelas',
            'cod' => 'NS-MCN',
        ]);

        $mecula = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mecula',
            'cod' => 'NS-MCL',
        ]);

        $metarica = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Metarica',
            'cod' => 'NS-MTR',
        ]);

        $muembe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Muembe',
            'cod' => 'NS-MUB',
        ]);

        $ngauma = new District([
            'id' => Str::uuid()->toString(),
            'name' => "N'gauma",
            'cod' => 'NS-NGM',
        ]);

        $nipepe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nipepe',
            'cod' => 'NS-NPP',
        ]);

        $sanga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Sanga',
            'cod' => 'NS-SNG',
        ]);

        $niassa->districts()->saveMany([$chimbonila, $cuamba, $lago, $lichinga, $majune, $mandimba, $marrupa, $maua, $mavago, $mecanhelas, $mecula, $metarica, $muembe, $ngauma, $nipepe, $sanga]);

        // SOFALA
        $sofala = Province::where('cod', 'SF')->first();

        $beira = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Beira',
            'cod' => 'SF-BRA',
        ]);

        $buzi = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Búzi',
            'cod' => 'SF-BUZ',
        ]);

        $caia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Caia',
            'cod' => 'SF-CAI',
        ]);

        $chemba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chemba',
            'cod' => 'SF-CHB',
        ]);

        $cheringoma = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Cheringoma',
            'cod' => 'SF-CRG',
        ]);

        $chibabava = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chibabava',
            'cod' => 'SF-CBB',
        ]);

        $dondo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Dondo',
            'cod' => 'SF-DND',
        ]);

        $gorongosa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Gorongosa',
            'cod' => 'SF-GRG',
        ]);

        $machanga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Machanga',
            'cod' => 'SF-MCG',
        ]);

        $maringue = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Maringué',
            'cod' => 'SF-MRG',
        ]);

        $marromeu = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Marromeu',
            'cod' => 'SF-MRM',
        ]);

        $muanza = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Muanza',
            'cod' => 'SF-MUZ',
        ]);

        $nhamatanda = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nhamatanda',
            'cod' => 'SF-NMT',
        ]);

        $sofala->districts()->saveMany([$beira, $buzi, $caia, $chemba, $cheringoma, $chibabava, $dondo, $gorongosa, $machanga, $maringue, $marromeu, $muanza, $nhamatanda]);

        // Tete
        $tete = Province::where('cod', 'TT')->first();

        $angonia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Angónia',
            'cod' => 'TT-ANG',
        ]);

        $cahoraBassa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Cahora-Bassa',
            'cod' => 'TT-CHB',
        ]);

        $changara = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Changara',
            'cod' => 'TT-CGR',
        ]);

        $chifunde = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chifunde',
            'cod' => 'TT-CFD',
        ]);

        $chiuta = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chiuta',
            'cod' => 'TT-CHT',
        ]);

        $doa = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Dôa',
            'cod' => 'TT-DOA',
        ]);

        $macanga = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Macanga',
            'cod' => 'TT-MCG',
        ]);

        $magoe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Magoé',
            'cod' => 'TT-MGE',
        ]);

        $marara = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Marara',
            'cod' => 'TT-MRR',
        ]);

        $maravia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Marávia',
            'cod' => 'TT-MRV',
        ]);

        $moatize = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Moatize',
            'cod' => 'TT-MTZ',
        ]);

        $mutarara = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mutarara',
            'cod' => 'TT-MTR',
        ]);

        $teteDistrict = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Tete',
            'cod' => 'TT-TTE',
        ]);

        $tsangano = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Tsangano',
            'cod' => 'TT-TSG',
        ]);

        $zumbo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Zumbo',
            'cod' => 'TT-ZMB',
        ]);

        $tete->districts()->saveMany([$angonia, $cahoraBassa, $changara, $chifunde, $chiuta, $doa, $macanga, $magoe, $marara, $maravia, $moatize, $mutarara, $teteDistrict, $tsangano, $zumbo]);

        // Tete
        $zambezia = Province::where('cod', 'ZB')->first();

        $altoMolocue = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Alto Molócue',
            'cod' => 'ZB-AML',
        ]);

        $chinde = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Chinde',
            'cod' => 'ZB-CHD',
        ]);

        $derre = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Derre',
            'cod' => 'ZB-DRR',
        ]);

        $gile = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Gilé',
            'cod' => 'ZB-GLE',
        ]);

        $gurue = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Gurué',
            'cod' => 'ZB-GRE',
        ]);

        $ile = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Ile',
            'cod' => 'ZB-ILE',
        ]);

        $inhassunge = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Inhassunge',
            'cod' => 'ZB-INS',
        ]);

        $luabo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Luabo',
            'cod' => 'ZB-LBO',
        ]);

        $lugela = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Lugela',
            'cod' => 'ZB-LGL',
        ]);

        $maganjaDaCosta = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Maganja da Costa',
            'cod' => 'ZB-MDC',
        ]);

        $milange = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Milange',
            'cod' => 'ZB-MLG',
        ]);

        $mocuba = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mocuba',
            'cod' => 'ZB-MCB',
        ]);

        $mocubela = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mocubela',
            'cod' => 'ZB-MBL',
        ]);

        $molumbo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Molumbo',
            'cod' => 'ZB-MLB',
        ]);

        $mopeia = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mopeia',
            'cod' => 'ZB-MPA',
        ]);

        $morrumbala = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Morrumbala',
            'cod' => 'ZB-MRB',
        ]);

        $mulevala = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Mulevala',
            'cod' => 'ZB-MLV',
        ]);

        $namacurra = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Namacurra',
            'cod' => 'ZB-NMC',
        ]);

        $namarroi = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Namarroi',
            'cod' => 'ZB-NMR',
        ]);

        $nicoadala = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nicoadala',
            'cod' => 'ZB-NCD',
        ]);

        $pebane = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Pebane',
            'cod' => 'ZB-PBN',
        ]);

        $quelimane = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Quelimane',
            'cod' => 'ZB-QLM',
        ]);

        $zambezia->districts()->saveMany([$altoMolocue, $chinde, $derre, $gile, $gurue, $ile, $inhassunge, $luabo, $lugela, $maganjaDaCosta, $milange, $mocuba, $mocubela, $molumbo, $mopeia, $morrumbala, $mulevala, $namacurra, $namarroi, $nicoadala, $pebane, $quelimane]);

        // Cidade de Maputo
        $maputoCidade = Province::where('cod', 'MC')->first();

        $kaMpfumo = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaMpfumo',
            'cod' => 'MC-KPF',
        ]);

        $nlhamankulu = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'Nlhamankulu',
            'cod' => 'MC-NLK',
        ]);

        $kaMaxaquene = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaMaxaquene',
            'cod' => 'MC-KMX',
        ]);

        $kaMavota = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaMavota',
            'cod' => 'MC-KMV',
        ]);

        $kaMubukwana = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaMubukwana',
            'cod' => 'MC-KMB',
        ]);

        $kaTembe = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaTembe',
            'cod' => 'MC-KTB',
        ]);

        $kaNyaka = new District([
            'id' => Str::uuid()->toString(),
            'name' => 'KaNyaka',
            'cod' => 'MC-KNK',
        ]);

        $maputoCidade->districts()->saveMany([$kaMpfumo, $nlhamankulu, $kaMaxaquene, $kaMavota, $kaMubukwana, $kaTembe, $kaNyaka]);
    }
}
