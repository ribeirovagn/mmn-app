<?php

use Illuminate\Database\Seeder;

class BanksTable extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('banks')->insert([
            ['country_id' => 1, 'code' => '654', 'name' => 'Banco A.J.Renner S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '246', 'name' => 'Banco ABC Brasil S.A.', 'url' => 'www.abcbrasil.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '025', 'name' => 'Banco Alfa S.A.', 'url' => 'www.bancoalfa.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '641', 'name' => 'Banco Alvorada S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '213', 'name' => 'Banco Arbi S.A.', 'url' => 'www.arbi.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '019', 'name' => 'Banco Azteca do Brasil S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '029', 'name' => 'Banco Banerj S.A.', 'url' => 'www.banerj.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '000', 'name' => 'Banco Bankpar S.A.', 'url' => 'www.aexp.com', 'main' => 0],
            ['country_id' => 1, 'code' => '740', 'name' => 'Banco Barclays S.A.', 'url' => 'www.barclays.com', 'main' => 0],
            ['country_id' => 1, 'code' => '107', 'name' => 'Banco BBM S.A.', 'url' => 'www.bbmbank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '031', 'name' => 'Banco Beg S.A.', 'url' => 'www.itau.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '739', 'name' => 'Banco BGN S.A.', 'url' => 'www.bgn.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '096', 'name' => 'Banco BM&F de Serviços de Liquidação e Custódia S.A', 'url' => 'www.bmf.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '318', 'name' => 'Banco BMG S.A.', 'url' => 'www.bancobmg.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '752', 'name' => 'Banco BNP Paribas Brasil S.A.', 'url' => 'www.bnpparibas.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '248', 'name' => 'Banco Boavista Interatlântico S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '218', 'name' => 'Banco Bonsucesso S.A.', 'url' => 'www.bancobonsucesso.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '065', 'name' => 'Banco Bracce S.A.', 'url' => 'www.lemon.com', 'main' => 0],
            ['country_id' => 1, 'code' => '036', 'name' => 'Banco Bradesco BBI S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '204', 'name' => 'Banco Bradesco Cartões S.A.', 'url' => 'www.iamex.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '394', 'name' => 'Banco Bradesco Financiamentos S.A.', 'url' => 'www.bmc.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '237', 'name' => 'Banco Bradesco S.A.', 'url' => 'www.bradesco.com.br', 'main' => 1],
            ['country_id' => 1, 'code' => '225', 'name' => 'Banco Brascan S.A.', 'url' => 'www.bancobrascan.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M15', 'name' => 'Banco BRJ S.A.', 'url' => 'www.brjbank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '208', 'name' => 'Banco BTG Pactual S.A.', 'url' => 'www.pactual.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '044', 'name' => 'Banco BVA S.A.', 'url' => 'www.bancobva.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '263', 'name' => 'Banco Cacique S.A.', 'url' => 'www.bancocacique.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '473', 'name' => 'Banco Caixa Geral - Brasil S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '412', 'name' => 'Banco Capital S.A.', 'url' => 'www.bancocapital.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '040', 'name' => 'Banco Cargill S.A.', 'url' => 'www.bancocargill.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '745', 'name' => 'Banco Citibank S.A.', 'url' => 'www.citibank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M08', 'name' => 'Banco Citicard S.A.', 'url' => 'www.credicardbanco.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '241', 'name' => 'Banco Clássico S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => 'M19', 'name' => 'Banco CNH Capital S.A.', 'url' => 'www.bancocnh.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '215', 'name' => 'Banco Comercial e de Investimento Sudameris S.A.', 'url' => 'www.sudameris.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '756', 'name' => 'Banco Cooperativo do Brasil S.A. - BANCOOB', 'url' => 'www.bancoob.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '748', 'name' => 'Banco Cooperativo Sicredi S.A.', 'url' => 'www.sicredi.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '075', 'name' => 'Banco CR2 S.A.', 'url' => 'www.bancocr2.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '721', 'name' => 'Banco Credibel S.A.', 'url' => 'www.credibel.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '222', 'name' => 'Banco Credit Agricole Brasil S.A.', 'url' => 'www.calyon.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '505', 'name' => 'Banco Credit Suisse (Brasil) S.A.', 'url' => 'www.csfb.com', 'main' => 0],
            ['country_id' => 1, 'code' => '229', 'name' => 'Banco Cruzeiro do Sul S.A.', 'url' => 'www.bcsul.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '266', 'name' => 'Banco Cédula S.A.', 'url' => 'www.bancocedula.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '003', 'name' => 'Banco da Amazônia S.A.', 'url' => 'www.bancoamazonia.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '083-3', 'name' => 'Banco da China Brasil S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => 'M21', 'name' => 'Banco Daimlerchrysler S.A.', 'url' => 'www.bancodaimlerchrysler.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '707', 'name' => 'Banco Daycoval S.A.', 'url' => 'www.daycoval.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '300', 'name' => 'Banco de La Nacion Argentina', 'url' => 'www.bna.com.ar', 'main' => 0],
            ['country_id' => 1, 'code' => '495', 'name' => 'Banco de La Provincia de Buenos Aires', 'url' => 'www.bapro.com.ar', 'main' => 0],
            ['country_id' => 1, 'code' => '494', 'name' => 'Banco de La Republica Oriental del Uruguay', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => 'M06', 'name' => 'Banco de Lage Landen Brasil S.A.', 'url' => 'www.delagelanden.com', 'main' => 0],
            ['country_id' => 1, 'code' => '024', 'name' => 'Banco de Pernambuco S.A. - BANDEPE', 'url' => 'www.bandepe.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '456', 'name' => 'Banco de Tokyo-Mitsubishi UFJ Brasil S.A.', 'url' => 'www.btm.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '214', 'name' => 'Banco Dibens S.A.', 'url' => 'www.bancodibens.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '001', 'name' => 'Banco do Brasil S.A.', 'url' => 'www.bb.com.br', 'main' => 1],
            ['country_id' => 1, 'code' => '047', 'name' => 'Banco do Estado de Sergipe S.A.', 'url' => 'www.banese.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '037', 'name' => 'Banco do Estado do Pará S.A.', 'url' => 'www.banparanet.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '039', 'name' => 'Banco do Estado do Piauí S.A. - BEP', 'url' => 'www.bep.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '041', 'name' => 'Banco do Estado do Rio Grande do Sul S.A.', 'url' => 'www.banrisul.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '004', 'name' => 'Banco do Nordeste do Brasil S.A.', 'url' => 'www.banconordeste.gov.br', 'main' => 0],
            ['country_id' => 1, 'code' => '265', 'name' => 'Banco Fator S.A.', 'url' => 'www.bancofator.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M03', 'name' => 'Banco Fiat S.A.', 'url' => 'www.bancofiat.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '224', 'name' => 'Banco Fibra S.A.', 'url' => 'www.bancofibra.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '626', 'name' => 'Banco Ficsa S.A.', 'url' => 'www.ficsa.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M18', 'name' => 'Banco Ford S.A.', 'url' => 'www.bancoford.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '233', 'name' => 'Banco GE Capital S.A.', 'url' => 'www.ge.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '734', 'name' => 'Banco Gerdau S.A.', 'url' => 'www.bancogerdau.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M07', 'name' => 'Banco GMAC S.A.', 'url' => 'www.bancogm.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '612', 'name' => 'Banco Guanabara S.A.', 'url' => 'www.bcoguan.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M22', 'name' => 'Banco Honda S.A.', 'url' => 'www.bancohonda.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '063', 'name' => 'Banco Ibi S.A. Banco Múltiplo', 'url' => 'www.ibi.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M11', 'name' => 'Banco IBM S.A.', 'url' => 'www.ibm.com/br/financing/', 'main' => 0],
            ['country_id' => 1, 'code' => '604', 'name' => 'Banco Industrial do Brasil S.A.', 'url' => 'www.bancoindustrial.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '320', 'name' => 'Banco Industrial e Comercial S.A.', 'url' => 'www.bicbanco.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '653', 'name' => 'Banco Indusval S.A.', 'url' => 'www.indusval.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '630', 'name' => 'Banco Intercap S.A.', 'url' => 'www.intercap.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '077-9', 'name' => 'Banco Intermedium S.A.', 'url' => 'www.intermedium.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '249', 'name' => 'Banco Investcred Unibanco S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => 'M09', 'name' => 'Banco Itaucred Financiamentos S.A.', 'url' => 'www.itaucred.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '184', 'name' => 'Banco Itaú BBA S.A.', 'url' => 'www.itaubba.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '479', 'name' => 'Banco ItaúBank S.A', 'url' => 'www.itaubank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '376', 'name' => 'Banco J. P. Morgan S.A.', 'url' => 'www.jpmorgan.com', 'main' => 0],
            ['country_id' => 1, 'code' => '074', 'name' => 'Banco J. Safra S.A.', 'url' => 'www.jsafra.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '217', 'name' => 'Banco John Deere S.A.', 'url' => 'www.johndeere.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '076', 'name' => 'Banco KDB S.A.', 'url' => 'www.bancokdb.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '757', 'name' => 'Banco KEB do Brasil S.A.', 'url' => 'www.bancokeb.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '600', 'name' => 'Banco Luso Brasileiro S.A.', 'url' => 'www.lusobrasileiro.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '212', 'name' => 'Banco Matone S.A.', 'url' => 'www.bancomatone.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M12', 'name' => 'Banco Maxinvest S.A.', 'url' => 'www.bancomaxinvest.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '389', 'name' => 'Banco Mercantil do Brasil S.A.', 'url' => 'www.mercantil.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '746', 'name' => 'Banco Modal S.A.', 'url' => 'www.bancomodal.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M10', 'name' => 'Banco Moneo S.A.', 'url' => 'www.bancomoneo.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '738', 'name' => 'Banco Morada S.A.', 'url' => 'www.bancomorada.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '066', 'name' => 'Banco Morgan Stanley S.A.', 'url' => 'www.morganstanley.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '243', 'name' => 'Banco Máxima S.A.', 'url' => 'www.bancomaxima.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '045', 'name' => 'Banco Opportunity S.A.', 'url' => 'www.opportunity.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M17', 'name' => 'Banco Ourinvest S.A.', 'url' => 'www.ourinvest.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '623', 'name' => 'Banco Panamericano S.A.', 'url' => 'www.panamericano.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '611', 'name' => 'Banco Paulista S.A.', 'url' => 'www.bancopaulista.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '613', 'name' => 'Banco Pecúnia S.A.', 'url' => 'www.bancopecunia.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '094-2', 'name' => 'Banco Petra S.A.', 'url' => 'www.personaltrader.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '643', 'name' => 'Banco Pine S.A.', 'url' => 'www.bancopine.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '724', 'name' => 'Banco Porto Seguro S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '735', 'name' => 'Banco Pottencial S.A.', 'url' => 'www.pottencial.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '638', 'name' => 'Banco Prosper S.A.', 'url' => 'www.bancoprosper.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M24', 'name' => 'Banco PSA Finance Brasil S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '747', 'name' => 'Banco Rabobank International Brasil S.A.', 'url' => 'www.rabobank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '088-4', 'name' => 'Banco Randon S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '356', 'name' => 'Banco Real S.A.', 'url' => 'www.bancoreal.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '633', 'name' => 'Banco Rendimento S.A.', 'url' => 'www.rendimento.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '741', 'name' => 'Banco Ribeirão Preto S.A.', 'url' => 'www.brp.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M16', 'name' => 'Banco Rodobens S.A.', 'url' => 'www.rodobens.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '072', 'name' => 'Banco Rural Mais S.A.', 'url' => 'www.rural.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '453', 'name' => 'Banco Rural S.A.', 'url' => 'www.rural.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '422', 'name' => 'Banco Safra S.A.', 'url' => 'www.safra.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '033', 'name' => 'Banco Santander (Brasil) S.A.', 'url' => 'www.santander.com.br', 'main' => 1],
            ['country_id' => 1, 'code' => '250', 'name' => 'Banco Schahin S.A.', 'url' => 'www.bancoschahin.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '743', 'name' => 'Banco Semear S.A.', 'url' => 'www.bancosemear.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '749', 'name' => 'Banco Simples S.A.', 'url' => 'www.bancosimples.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '366', 'name' => 'Banco Société Générale Brasil S.A.', 'url' => 'www.sgbrasil.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '637', 'name' => 'Banco Sofisa S.A.', 'url' => 'www.sofisa.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '012', 'name' => 'Banco Standard de Investimentos S.A.', 'url' => 'www.standardbank.com', 'main' => 0],
            ['country_id' => 1, 'code' => '464', 'name' => 'Banco Sumitomo Mitsui Brasileiro S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '082-5', 'name' => 'Banco Topázio S.A.', 'url' => 'www.bancotopazio.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M20', 'name' => 'Banco Toyota do Brasil S.A.', 'url' => 'www.bancotoyota.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M13', 'name' => 'Banco Tricury S.A.', 'url' => 'www.tricury.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '634', 'name' => 'Banco Triângulo S.A.', 'url' => 'www.tribanco.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M14', 'name' => 'Banco Volkswagen S.A.', 'url' => 'www.bancovw.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => 'M23', 'name' => 'Banco Volvo (Brasil) S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '655', 'name' => 'Banco Votorantim S.A.', 'url' => 'www.bancovotorantim.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '610', 'name' => 'Banco VR S.A.', 'url' => 'www.vr.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '370', 'name' => 'Banco WestLB do Brasil S.A.', 'url' => 'www.westlb.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '021', 'name' => 'BANESTES S.A. Banco do Estado do Espírito Santo', 'url' => 'www.banestes.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '719', 'name' => 'Banif-Banco Internacional do Funchal (Brasil)S.A.', 'url' => 'www.banif.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '755', 'name' => 'Bank of America Merrill Lynch Banco Múltiplo S.A.', 'url' => 'www.ml.com', 'main' => 0],
            ['country_id' => 1, 'code' => '744', 'name' => 'BankBoston N.A.', 'url' => 'www.bankboston.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '073', 'name' => 'BB Banco Popular do Brasil S.A.', 'url' => 'www.bancopopulardobrasil.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '078', 'name' => 'BES Investimento do Brasil S.A.-Banco de Investimento', 'url' => 'www.besinvestimento.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '069', 'name' => 'BPN Brasil Banco Múltiplo S.A.', 'url' => 'www.bpnbrasil.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '070', 'name' => 'BRB - Banco de Brasília S.A.', 'url' => 'www.brb.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '092-2', 'name' => 'Brickell S.A. Crédito, financiamento e Investimento', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '104', 'name' => 'Caixa Econômica Federal', 'url' => 'www.caixa.gov.br', 'main' => 1],
            ['country_id' => 1, 'code' => '477', 'name' => 'Citibank N.A.', 'url' => 'www.citibank.com/brasil', 'main' => 0],
            ['country_id' => 1, 'code' => '081-7', 'name' => 'Concórdia Banco S.A.', 'url' => 'www.concordiabanco.com', 'main' => 0],
            ['country_id' => 1, 'code' => '097-3', 'name' => 'Cooperativa Central de Crédito Noroeste Brasileiro Ltda.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '085-x', 'name' => 'Cooperativa Central de Crédito Urbano-CECRED', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '099-x', 'name' => 'Cooperativa Central de Economia e Credito Mutuo das Unicreds', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '090-2', 'name' => 'Cooperativa Central de Economia e Crédito Mutuo das Unicreds', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '089-2', 'name' => 'Cooperativa de Crédito Rural da Região de Mogiana', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '087-6', 'name' => 'Cooperativa Unicred Central Santa Catarina', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '098-1', 'name' => 'Credicorol Cooperativa de Crédito Rural', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '487', 'name' => 'Deutsche Bank S.A. - Banco Alemão', 'url' => 'www.deutsche-bank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '751', 'name' => 'Dresdner Bank Brasil S.A. - Banco Múltiplo', 'url' => 'www.dkib.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '064', 'name' => 'Goldman Sachs do Brasil Banco Múltiplo S.A.', 'url' => 'www.goldmansachs.com', 'main' => 0],
            ['country_id' => 1, 'code' => '062', 'name' => 'Hipercard Banco Múltiplo S.A.', 'url' => 'www.hipercard.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '399', 'name' => 'HSBC Bank Brasil S.A. - Banco Múltiplo', 'url' => 'www.hsbc.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '168', 'name' => 'HSBC Finance (Brasil) S.A. - Banco Múltiplo', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '492', 'name' => 'ING Bank N.V.', 'url' => 'www.ing.com', 'main' => 0],
            ['country_id' => 1, 'code' => '652', 'name' => 'Itaú Unibanco Holding S.A.', 'url' => 'www.itau.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '341', 'name' => 'Itaú Unibanco S.A.', 'url' => 'www.itau.com.br', 'main' => 1],
            ['country_id' => 1, 'code' => '079', 'name' => 'JBS Banco S.A.', 'url' => 'www.bancojbs.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '488', 'name' => 'JPMorgan Chase Bank', 'url' => 'www.jpmorganchase.com', 'main' => 0],
            ['country_id' => 1, 'code' => '014', 'name' => 'Natixis Brasil S.A. Banco Múltiplo', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '753', 'name' => 'NBC Bank Brasil S.A. - Banco Múltiplo', 'url' => 'www.nbcbank.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '086-8', 'name' => 'OBOE Crédito Financiamento e Investimento S.A.', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '254', 'name' => 'Paraná Banco S.A.', 'url' => 'www.paranabanco.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '409', 'name' => 'UNIBANCO - União de Bancos Brasileiros S.A.', 'url' => 'www.unibanco.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '230', 'name' => 'Unicard Banco Múltiplo S.A.', 'url' => 'www.unicard.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '091-4', 'name' => 'Unicred Central do Rio Grande do Sul', 'url' => 'www.unicred-rs.com.br', 'main' => 0],
            ['country_id' => 1, 'code' => '084', 'name' => 'Unicred Norte do Paraná', 'url' => '-', 'main' => 0],
            ['country_id' => 1, 'code' => '260', 'name' => 'Nubank - Nu Pagamentos S.A', 'url' => '-', 'main' => 0]
        ]);
    }

}
