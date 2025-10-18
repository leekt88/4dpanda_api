var arf = "";
var drdate="";
var acnt=0;
function UpdateStatus(){
var curdate = new Date();
//alert(curdate.getHours());
if ($('#curpos').val()==1){
	if(0!==arf.length){
		//exist, do nothing
	}else{
		if (curdate.getHours()===15 || curdate.getHours()===18 || curdate.getHours()===19 || curdate.getHours()===20){
			arf = window.setInterval("UpdateStatus('')", 3000);
		}else{
		arf = window.setInterval("UpdateStatus('')", 10000);
		}
	}
	getWest(drdate);

}
acnt++;
};

function getWest(sdrawpastdate){
	var purl="/fetchall";
	$.ajax({
		  type: 'GET',
		  url: purl,
		  timeout: 10000,
		  dataType: 'json',
		  cache: false,
		  beforeSend: function() {
			  $("#loadmsg").hide(); // Dont show the loading message
		  },
          complete: function() {
        	  setTimeout(hideloader, 100);
          },
          error: function(jqXHR, textStatus, errorThrown) {
        	  hideloader;
        	  return false;
          },
		  success: function (data) {
				try{
					$("#mdd").html("Date: "+data.M4D.DD);
					$("#mdn").html("Draw No: "+data.M4D.DN);
					$("#mpbdd").html("Date: "+data.M4D.DD);
					$("#mpbdn").html("Draw No: "+data.M4D.DN);
					$("#mp1").html(data.M4D.P1);
					$("#mp2").html(data.M4D.P2);
					$("#mp3").html(data.M4D.P3);
					$("#mpbp1").html(data.M4D.P1);
					$("#mpbp2").html(data.M4D.P2);
					$("#mpbp3").html(data.M4D.P3);
					$("#ms1").html(data.M4D.S1);
					$("#ms2").html(data.M4D.S2);
					$("#ms3").html(data.M4D.S3);
					$("#ms4").html(data.M4D.S4);
					$("#ms5").html(data.M4D.S5);
					$("#ms6").html(data.M4D.S6);
					$("#ms7").html(data.M4D.S7);
					$("#ms8").html(data.M4D.S8);
					$("#ms9").html(data.M4D.S9);
					$("#ms10").html(data.M4D.S10);
					$("#ms11").html(data.M4D.S11);
					$("#ms12").html(data.M4D.S12);
					$("#ms13").html(data.M4D.S13);
					$("#mc1").html(data.M4D.C1);
					$("#mc2").html(data.M4D.C2);
					$("#mc3").html(data.M4D.C3);
					$("#mc4").html(data.M4D.C4);
					$("#mc5").html(data.M4D.C5);
					$("#mc6").html(data.M4D.C6);
					$("#mc7").html(data.M4D.C7);
					$("#mc8").html(data.M4D.C8);
					$("#mc9").html(data.M4D.C9);
					$("#mc10").html(data.M4D.C10);				
					$("#ml1").html(data.M4D.L1);
					$("#ml2").html(data.M4D.L2);				
					$("#ml3").html(data.M4D.L3);				
					$("#ml4").html(data.M4D.L4);				
					$("#ml5").html(data.M4D.L5);				
					$("#ml6").html(data.M4D.L6);				
					$("#ml7").html(data.M4D.L7);				
					$("#ml8").html(data.M4D.L8);
					$("#mlb1").html(data.M4D.LB1);				
					$("#mlb2").html(data.M4D.LB2);				
					$("#mjp1").html(data.M4D.JP1);				
					$("#mjp2").html(data.M4D.JP2);
					if (data.M4D.JP1WON>=1){
						$("#mjp1won").html("Won");
					}else if(data.M4D.JP1WON>0){
						$("#mjp1won").html("Partially Won");
					}else{
						$("#mjp1won").html("");
					}
					if (data.M4D.JP2WON>=1){
						$("#mjp2won").html("Won");
					}else if(data.M4D.JP2WON>0){
						$("#mjp2won").html("Partially Won");
					}else{
						$("#mjp2won").html("");
					}
					$("#mestjp1").html(data.M4D.ESTJP1);				
					$("#mestjp2").html(data.M4D.ESTJP2);
					if(drdate==""){
						$("#mestsec").show();
					}else{
						$("#mestsec").hide();
					}
					if (data.M4D.COMPLETE4D==0){
						$("#mlive").show();
					}else{
						$("#mlive").hide();
					}					
					if (data.M4D.COMPLETELIFE==0){
						$("#mllive").show();
					}else{
						$("#mllive").hide();
					}					

				}catch (err){
					
				}

				try{
					$("#ddd").html("Date: "+data.DMC4D.DD);
					$("#ddn").html("Draw No: "+data.DMC4D.DN);
					$("#dp1").html(data.DMC4D.P1);
					$("#dp2").html(data.DMC4D.P2);
					$("#dp3").html(data.DMC4D.P3);
					$("#ds1").html(data.DMC4D.S1);
					$("#ds2").html(data.DMC4D.S2);
					$("#ds3").html(data.DMC4D.S3);
					$("#ds4").html(data.DMC4D.S4);
					$("#ds5").html(data.DMC4D.S5);
					$("#ds6").html(data.DMC4D.S6);
					$("#ds7").html(data.DMC4D.S7);
					$("#ds8").html(data.DMC4D.S8);
					$("#ds9").html(data.DMC4D.S9);
					$("#ds10").html(data.DMC4D.S10);
					$("#dc1").html(data.DMC4D.C1);
					$("#dc2").html(data.DMC4D.C2);
					$("#dc3").html(data.DMC4D.C3);
					$("#dc4").html(data.DMC4D.C4);
					$("#dc5").html(data.DMC4D.C5);
					$("#dc6").html(data.DMC4D.C6);
					$("#dc7").html(data.DMC4D.C7);
					$("#dc8").html(data.DMC4D.C8);
					$("#dc9").html(data.DMC4D.C9);
					$("#dc10").html(data.DMC4D.C10);
					$("#djp1").html(data.DMC4D.JP1);				
					$("#djp2").html(data.DMC4D.JP2);
					$("#djp3").html(data.DMC4D.JP3);
					if (data.DMC4D.JP1WON==1){
						$("#djp1won").html("Won");
					}else if(data.DMC4D.JP1WON==2){
						$("#djp1won").html("Partially Won");
					}else{
						$("#djp1won").html("");
					}
					if (data.DMC4D.JP2WON==1){
						$("#djp2won").html("Won");
					}else if(data.DMC4D.JP2WON==2){
						$("#djp2won").html("Partially Won");
					}else{
						$("#djp2won").html("");
					}
					if (data.DMC4D.JP3WON==1){
						$("#djp3won").html("Won");
					}else if(data.DMC6D.JP3WON==2){
						$("#djp3won").html("Partially Won");
					}else{
						$("#djp3won").html("");
					}
					$("#destjp1").html(data.DMC4D.ESTJP1);				
					$("#destjp2").html(data.DMC4D.ESTJP2);
					$("#destjp3").html(data.DMC4D.ESTJP3);
					if(drdate==""){
						$("#destsec").show();
					}else{
						$("#destsec").hide();
					}
					if (data.DMC4D.COMPLETE4D==0){
						$("#dlive").show();
					}else{
						$("#dlive").hide();
					}					
				}catch (err){
					
				}
				
				try{
					$("#d3dd").html("Date: "+data.DMC6D.DD);
					$("#d3dn").html("Draw No: "+data.DMC6D.DN);
					$("#d3p1").html(data.DMC6D.P1);
					$("#d3p2").html(data.DMC6D.P2);
					$("#d3p3").html(data.DMC6D.P3);
					$("#d3p1zodiac").html(data.DMC6D.P1B);
					$("#d3p2zodiac").html(data.DMC6D.P2B);
					$("#d3p3zodiac").html(data.DMC6D.P3B);
					$("#d3s1").html(data.DMC6D.S1);
					$("#d3s2").html(data.DMC6D.S2);
					$("#d3s3").html(data.DMC6D.S3);
					$("#d3s4").html(data.DMC6D.S4);
					$("#d3s5").html(data.DMC6D.S5);
					$("#d3s6").html(data.DMC6D.S6);
					$("#d3s7").html(data.DMC6D.S7);
					$("#d3s8").html(data.DMC6D.S8);
					$("#d3s9").html(data.DMC6D.S9);
					$("#d3s10").html(data.DMC6D.S10);
					$("#d3c1").html(data.DMC6D.C1);
					$("#d3c2").html(data.DMC6D.C2);
					$("#d3c3").html(data.DMC6D.C3);
					$("#d3c4").html(data.DMC6D.C4);
					$("#d3c5").html(data.DMC6D.C5);
					$("#d3c6").html(data.DMC6D.C6);
					$("#d3c7").html(data.DMC6D.C7);
					$("#d3c8").html(data.DMC6D.C8);
					$("#d3c9").html(data.DMC6D.C9);
					$("#d3c10").html(data.DMC6D.C10);
					$("#d3jp1").html(data.DMC6D.J61);
					$("#d3jp2").html(data.DMC6D.J62);
					$("#d3jp3").html(data.DMC6D.J63);
					if (data.DMC6D.J61WON==1){
						$("#d3jp1won").html("Won");
					}else if(data.DMC6D.J61WON==2){
						$("#d3jp1won").html("Partially Won");
					}else{
						$("#d3jp1won").html("");
					}
					if (data.DMC6D.J62WON==1){
						$("#d3jp2won").html("Won");
					}else if(data.DMC6D.J62WON==2){
						$("#d3jp2won").html("Partially Won");
					}else{
						$("#d3jp2won").html("");
					}
					if (data.DMC6D.J63WON==1){
						$("#d3jp3won").html("Won");
					}else if(data.DMC6D.J63WON==2){
						$("#d3jp3won").html("Partially Won");
					}else{
						$("#d3jp3won").html("");
					}
					if (data.DMC6D.COMPLETE4D==0){
						$("#d3live").show();
					}else{
						$("#d3live").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#tdd").html("Date: "+data.TT.DD);
					$("#tdn").html("Draw No: "+data.TT.DN);
					$("#tp1").html(data.TT.P1);
					$("#tp2").html(data.TT.P2);
					$("#tp3").html(data.TT.P3);
					$("#ts1").html(data.TT.S1);
					$("#ts2").html(data.TT.S2);
					$("#ts3").html(data.TT.S3);
					$("#ts4").html(data.TT.S4);
					$("#ts5").html(data.TT.S5);
					$("#ts6").html(data.TT.S6);
					$("#ts7").html(data.TT.S7);
					$("#ts8").html(data.TT.S8);
					$("#ts9").html(data.TT.S9);
					$("#ts10").html(data.TT.S10);
					$("#ts11").html(data.TT.S11);
					$("#ts12").html(data.TT.S12);
					$("#ts13").html(data.TT.S13);
					$("#tc1").html(data.TT.C1);
					$("#tc2").html(data.TT.C2);
					$("#tc3").html(data.TT.C3);
					$("#tc4").html(data.TT.C4);
					$("#tc5").html(data.TT.C5);
					$("#tc6").html(data.TT.C6);
					$("#tc7").html(data.TT.C7);
					$("#tc8").html(data.TT.C8);
					$("#tc9").html(data.TT.C9);
					$("#tc10").html(data.TT.C10);
					//$("#tzodiac").html(data.TT.ZODIAC);
					$("#tjp1").html(data.TT.JP1);				
					$("#tjp2").html(data.TT.JP2);
					if (data.TT.JP1WON>=1){
						$("#tjp1won").html("Won");
					}else if(data.TT.JP1WON>0){
						$("#tjp1won").html("Partially Won");
					}else{
						$("#tjp1won").html("");
					}
					if (data.TT.JP2WON>=1){
						$("#tjp2won").html("Won");
					}else if(data.TT.JP2WON>0){
						$("#tjp2won").html("Partially Won");
					}else{
						$("#tjp2won").html("");
					}
					$("#testjp1").html(data.TT.ESTJP1);				
					$("#testjp2").html(data.TT.ESTJP2);
					if(drdate==""){
						$("#testsec").show();
					}else{
						$("#testsec").hide();
					}
					if (data.TT.COMPLETED4D==0){
						$("#tlive").show();
					}else{
						$("#tlive").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#sdd").html("Date: "+data.SGP4D.DD);
					$("#sdn").html("Draw No: "+data.SGP4D.DN);
					$("#sp1").html(data.SGP4D.P1);
					$("#sp2").html(data.SGP4D.P2);
					$("#sp3").html(data.SGP4D.P3);
					$("#ss1").html(data.SGP4D.S1);
					$("#ss2").html(data.SGP4D.S2);
					$("#ss3").html(data.SGP4D.S3);
					$("#ss4").html(data.SGP4D.S4);
					$("#ss5").html(data.SGP4D.S5);
					$("#ss6").html(data.SGP4D.S6);
					$("#ss7").html(data.SGP4D.S7);
					$("#ss8").html(data.SGP4D.S8);
					$("#ss9").html(data.SGP4D.S9);
					$("#ss10").html(data.SGP4D.S10);
					$("#sc1").html(data.SGP4D.C1);
					$("#sc2").html(data.SGP4D.C2);
					$("#sc3").html(data.SGP4D.C3);
					$("#sc4").html(data.SGP4D.C4);
					$("#sc5").html(data.SGP4D.C5);
					$("#sc6").html(data.SGP4D.C6);
					$("#sc7").html(data.SGP4D.C7);
					$("#sc8").html(data.SGP4D.C8);
					$("#sc9").html(data.SGP4D.C9);
					$("#sc10").html(data.SGP4D.C10);
					if (data.SGP4D.COMPLETED4D==0){
						$("#sgp4dlive").show();
					}else{
						$("#sgp4dlive").hide();
					}
				}catch (err){
					
				}
				try{
					$("#stdd").html("Date: "+data.STC.DD);
					$("#stdn").html("Draw No: "+data.STC.DN);
					$("#stp1").html(data.STC.P1);
					$("#stp2").html(data.STC.P2);
					$("#stp3").html(data.STC.P3);
					$("#sts1").html(data.STC.S1);
					$("#sts2").html(data.STC.S2);
					$("#sts3").html(data.STC.S3);
					$("#sts4").html(data.STC.S4);
					$("#sts5").html(data.STC.S5);
					$("#sts6").html(data.STC.S6);
					$("#sts7").html(data.STC.S7);
					$("#sts8").html(data.STC.S8);
					$("#sts9").html(data.STC.S9);
					$("#sts10").html(data.STC.S10);
					$("#sts11").html(data.STC.S11);
					$("#sts12").html(data.STC.S12);
					$("#sts13").html(data.STC.S13);
					$("#stc1").html(data.STC.C1);
					$("#stc2").html(data.STC.C2);
					$("#stc3").html(data.STC.C3);
					$("#stc4").html(data.STC.C4);
					$("#stc5").html(data.STC.C5);
					$("#stc6").html(data.STC.C6);
					$("#stc7").html(data.STC.C7);
					$("#stc8").html(data.STC.C8);
					$("#stc9").html(data.STC.C9);
					$("#stc10").html(data.STC.C10);	
					if (data.STC.COMPLETED4D==0){
						$("#stclive").show();
					}else{
						$("#stclive").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#sbdd").html("Date: "+data.SB.DD);
					$("#sbdn").html("Draw No: "+data.SB.DN);
					$("#sbp1").html(data.SB.P1);
					$("#sbp2").html(data.SB.P2);
					$("#sbp3").html(data.SB.P3);
					$("#sbs1").html(data.SB.S1);
					$("#sbs2").html(data.SB.S2);
					$("#sbs3").html(data.SB.S3);
					$("#sbs4").html(data.SB.S4);
					$("#sbs5").html(data.SB.S5);
					$("#sbs6").html(data.SB.S6);
					$("#sbs7").html(data.SB.S7);
					$("#sbs8").html(data.SB.S8);
					$("#sbs9").html(data.SB.S9);
					$("#sbs10").html(data.SB.S10);
					$("#sbs11").html(data.SB.S11);
					$("#sbs12").html(data.SB.S12);
					$("#sbs13").html(data.SB.S13);
					$("#sbc1").html(data.SB.C1);
					$("#sbc2").html(data.SB.C2);
					$("#sbc3").html(data.SB.C3);
					$("#sbc4").html(data.SB.C4);
					$("#sbc5").html(data.SB.C5);
					$("#sbc6").html(data.SB.C6);
					$("#sbc7").html(data.SB.C7);
					$("#sbc8").html(data.SB.C8);
					$("#sbc9").html(data.SB.C9);
					$("#sbc10").html(data.SB.C10);
					$("#sb3dp1").html(data.SB.P13D);
					$("#sb3dp2").html(data.SB.P23D);
					$("#sb3dp3").html(data.SB.P33D);
					$("#sbjp1").html(data.SB.JP1);
					$("#sbjp2").html(data.SB.JP2);
					if (data.SB.COMPLETE4D==0){
						$("#sblive").show();
					}else{
						$("#sblive").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#sbltdd").html("Date: "+data.SBLT.DD);
					$("#sbltdn").html("Draw No: "+data.SBLT.DN);
					$("#sbltdd2").html("Date: "+data.SBLT.DD);
					$("#sbltdn2").html("Draw No: "+data.SBLT.DN);
					$("#sblt1").html(data.SBLT.LT1);
					$("#sblt2").html(data.SBLT.LT2);
					$("#sblt3").html(data.SBLT.LT3);
					$("#sblt4").html(data.SBLT.LT4);
					$("#sblt5").html(data.SBLT.LT5);
					$("#sblt6").html(data.SBLT.LT6);
					$("#sblt7").html(data.SBLT.LT7);
					$("#sbltjp1").html(data.SBLT.LTJP1);
					$("#sbltjp2").html(data.SBLT.LTJP2);
					$("#sblt6g11").html(data.SBLT.LT6G11);
					$("#sblt6g12").html(data.SBLT.LT6G12);
					$("#sblt6g13").html(data.SBLT.LT6G13);
					$("#sblt6g14").html(data.SBLT.LT6G14);
					$("#sblt6g15").html(data.SBLT.LT6G15);
					$("#sblt6g16").html(data.SBLT.LT6G16);
					$("#sblt6g1jp").html(data.SBLT.LT6G1JP);
					$("#sblt6g21").html(data.SBLT.LT6G21);
					$("#sblt6g22").html(data.SBLT.LT6G22);
					$("#sblt6g23").html(data.SBLT.LT6G23);
					$("#sblt6g24").html(data.SBLT.LT6G24);
					$("#sblt6g25").html(data.SBLT.LT6G25);
					$("#sblt6g26").html(data.SBLT.LT6G26);
					$("#sblt6g2jp").html(data.SBLT.LT6G2JP);
					$("#sblt6g31").html(data.SBLT.LT6G31);
					$("#sblt6g32").html(data.SBLT.LT6G32);
					$("#sblt6g33").html(data.SBLT.LT6G33);
					$("#sblt6g34").html(data.SBLT.LT6G34);
					$("#sblt6g35").html(data.SBLT.LT6G35);
					$("#sblt6g36").html(data.SBLT.LT6G36);
					$("#sblt6g3jp").html(data.SBLT.LT6G3JP);
					$("#sblt6g41").html(data.SBLT.LT6G41);
					$("#sblt6g42").html(data.SBLT.LT6G42);
					$("#sblt6g43").html(data.SBLT.LT6G43);
					$("#sblt6g44").html(data.SBLT.LT6G44);
					$("#sblt6g45").html(data.SBLT.LT6G45);
					$("#sblt6g46").html(data.SBLT.LT6G46);
					$("#sblt6g4jp").html(data.SBLT.LT6G4JP);
					$("#sblt6g51").html(data.SBLT.LT6G51);
					$("#sblt6g52").html(data.SBLT.LT6G52);
					$("#sblt6g53").html(data.SBLT.LT6G53);
					$("#sblt6g54").html(data.SBLT.LT6G54);
					$("#sblt6g55").html(data.SBLT.LT6G55);
					$("#sblt6g56").html(data.SBLT.LT6G56);
					$("#sblt6g5jp").html(data.SBLT.LT6G5JP);
					$("#sblt5g11").html(data.SBLT.LT5G11);
					$("#sblt5g12").html(data.SBLT.LT5G12);
					$("#sblt5g13").html(data.SBLT.LT5G13);
					$("#sblt5g14").html(data.SBLT.LT5G14);
					$("#sblt5g15").html(data.SBLT.LT5G15);
					$("#sblt5g1jp").html(data.SBLT.LT5G1JP);
					$("#sblt5g21").html(data.SBLT.LT5G21);
					$("#sblt5g22").html(data.SBLT.LT5G22);
					$("#sblt5g23").html(data.SBLT.LT5G23);
					$("#sblt5g24").html(data.SBLT.LT5G24);
					$("#sblt5g25").html(data.SBLT.LT5G25);
					$("#sblt5g2jp").html(data.SBLT.LT5G2JP);
					$("#sblt5g31").html(data.SBLT.LT5G31);
					$("#sblt5g32").html(data.SBLT.LT5G32);
					$("#sblt5g33").html(data.SBLT.LT5G33);
					$("#sblt5g34").html(data.SBLT.LT5G34);
					$("#sblt5g35").html(data.SBLT.LT5G35);
					$("#sblt5g3jp").html(data.SBLT.LT5G3JP);
					$("#sblt5g41").html(data.SBLT.LT5G41);
					$("#sblt5g42").html(data.SBLT.LT5G42);
					$("#sblt5g43").html(data.SBLT.LT5G43);
					$("#sblt5g44").html(data.SBLT.LT5G44);
					$("#sblt5g45").html(data.SBLT.LT5G45);
					$("#sblt5g4jp").html(data.SBLT.LT5G4JP);
					$("#sblt5g51").html(data.SBLT.LT5G51);
					$("#sblt5g52").html(data.SBLT.LT5G52);
					$("#sblt5g53").html(data.SBLT.LT5G53);
					$("#sblt5g54").html(data.SBLT.LT5G54);
					$("#sblt5g55").html(data.SBLT.LT5G55);
					$("#sblt5g5jp").html(data.SBLT.LT5G5JP);
					$("#sblt5g61").html(data.SBLT.LT5G61);
					$("#sblt5g62").html(data.SBLT.LT5G62);
					$("#sblt5g63").html(data.SBLT.LT5G63);
					$("#sblt5g64").html(data.SBLT.LT5G64);
					$("#sblt5g65").html(data.SBLT.LT5G65);
					$("#sblt5g6jp").html(data.SBLT.LT5G6JP);
					$("#sblt5g71").html(data.SBLT.LT5G71);
					$("#sblt5g72").html(data.SBLT.LT5G72);
					$("#sblt5g73").html(data.SBLT.LT5G73);
					$("#sblt5g74").html(data.SBLT.LT5G74);
					$("#sblt5g75").html(data.SBLT.LT5G75);
					$("#sblt5g7jp").html(data.SBLT.LT5G7JP);
					$("#sblt5g81").html(data.SBLT.LT5G81);
					$("#sblt5g82").html(data.SBLT.LT5G82);
					$("#sblt5g83").html(data.SBLT.LT5G83);
					$("#sblt5g84").html(data.SBLT.LT5G84);
					$("#sblt5g85").html(data.SBLT.LT5G85);
					$("#sblt5g8jp").html(data.SBLT.LT5G8JP);
					if (data.SBLT.COMPLETELOTTO==0){
						$("#sbltlive").show();
						$("#sbltlive2").show();
					}else{
						$("#sbltlive").hide();
						$("#sbltlive2").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#swdd").html("Date: "+data.SCS.DD);
					$("#swdn").html("Draw No: "+data.SCS.DN);
					$("#swp1").html(data.SCS.P1);
					$("#swp2").html(data.SCS.P2);
					$("#swp3").html(data.SCS.P3);
					$("#sws1").html(data.SCS.S1);
					$("#sws2").html(data.SCS.S2);
					$("#sws3").html(data.SCS.S3);
					$("#sws4").html(data.SCS.S4);
					$("#sws5").html(data.SCS.S5);
					$("#sws6").html(data.SCS.S6);
					$("#sws7").html(data.SCS.S7);
					$("#sws8").html(data.SCS.S8);
					$("#sws9").html(data.SCS.S9);
					$("#sws10").html(data.SCS.S10);
					$("#swc1").html(data.SCS.C1);
					$("#swc2").html(data.SCS.C2);
					$("#swc3").html(data.SCS.C3);
					$("#swc4").html(data.SCS.C4);
					$("#swc5").html(data.SCS.C5);
					$("#swc6").html(data.SCS.C6);
					$("#swc7").html(data.SCS.C7);
					$("#swc8").html(data.SCS.C8);
					$("#swc9").html(data.SCS.C9);
					$("#swc10").html(data.SCS.C10);
					$("#swp13d").html(data.SCS.P13D);
					$("#swp23d").html(data.SCS.P23D);
					$("#swp33d").html(data.SCS.P33D);
					if (data.SCS.COMPLETED4D==0){
						$("#swlive").show();
					}else{
						$("#swlive").hide();
					}					

				}catch (err){
					
				}
				try{
					// Trích xuất các giá trị từ P6581 đến P6586
					let values = [
						data.TT.P6581,
						data.TT.P6582,
						data.TT.P6583,
						data.TT.P6584,
						data.TT.P6585,
						data.TT.P6586
					];

					// Sắp xếp các giá trị theo thứ tự tăng dần
					values.sort(function(a, b) {
						return a - b;
					});

					// Lưu vào một biến khác
					let sortedValues = values;

					$("#tt6581").html(sortedValues[0]);
					$("#tt6582").html(sortedValues[1]);
					$("#tt6583").html(sortedValues[2]);
					$("#tt6584").html(sortedValues[3]);
					$("#tt6585").html(sortedValues[4]);
					$("#tt6586").html(sortedValues[5]);
					let values2 = [
						data.TT.P6551,
						data.TT.P6552,
						data.TT.P6553,
						data.TT.P6554,
						data.TT.P6555,
						data.TT.P6556
					];

					// Sắp xếp các giá trị theo thứ tự tăng dần
					values2.sort(function(a, b) {
						return a - b;
					});

					// Lưu vào một biến khác
					let sortedValues2 = values2;
					$("#tt6551").html(sortedValues2[0]);
					$("#tt6552").html(sortedValues2[1]);
					$("#tt6553").html(sortedValues2[2]);
					$("#tt6554").html(sortedValues2[3]);
					$("#tt6555").html(sortedValues2[4]);
					$("#tt6556").html(sortedValues2[5]);
					let values3 = [
						data.TT.P6501,
						data.TT.P6502,
						data.TT.P6503,
						data.TT.P6504,
						data.TT.P6505,
						data.TT.P6506
					];

					// Sắp xếp các giá trị theo thứ tự tăng dần
					values3.sort(function(a, b) {
						return a - b;
					});

					// Lưu vào một biến khác
					let sortedValues3 = values3;
					$("#tt6501").html(sortedValues3[0]);
					$("#tt6502").html(sortedValues3[1]);
					$("#tt6503").html(sortedValues3[2]);
					$("#tt6504").html(sortedValues3[3]);
					$("#tt6505").html(sortedValues3[4]);
					$("#tt6506").html(sortedValues3[5]);

					$("#ttdd").html("Date: "+data.TT.DD);
					$("#ttdn").html("Draw No: "+data.TT.DN);
					$("#tt5d1").html(data.TT.P5D1);
					$("#tt5d2").html(data.TT.P5D2);
					$("#tt5d3").html(data.TT.P5D3);
					$("#tt5d4").html(data.TT.P5D4);
					$("#tt5d5").html(data.TT.P5D5);
					$("#tt5d6").html(data.TT.P5D6);
					$("#tt6d1").html(data.TT.P6D1);
					$("#tt6d2a").html(data.TT.P6D2A);
					$("#tt6d2b").html(data.TT.P6D2B);
					$("#tt6d3a").html(data.TT.P6D3A);
					$("#tt6d3b").html(data.TT.P6D3B);
					$("#tt6d4a").html(data.TT.P6D4A);
					$("#tt6d4b").html(data.TT.P6D4B);
					$("#tt6d5a").html(data.TT.P6D5A);
					$("#tt6d5b").html(data.TT.P6D5B);

					$("#tt650ex").html(data.TT.P650EX);
					$("#tt650jp1").html(data.TT.P650JP1);
					$("#tt650jp2").html(data.TT.P650JP2);
					$("#tt655jp").html(data.TT.P655JP);
					$("#tt658jp").html(data.TT.P658JP);
					$("#tt6631").html(data.TT.P6631);
					$("#tt6632").html(data.TT.P6632);
					$("#tt6633").html(data.TT.P6633);
					$("#tt6634").html(data.TT.P6634);
					$("#tt6635").html(data.TT.P6635);
					$("#tt6636").html(data.TT.P6636);
					$("#tt663jp").html(data.TT.P663JP);
					if(data.TT.ZODIAC!='images/zodiac/.png'){
						$("#tzodiac").html("<img src='/"+ data.TT.ZODIAC + "' style='width:40px;'/>");
					}
					if (data.TT.P650flag=="off"){
						$("#tt650l").hide();
						$("#tt650d").hide();
					}else{
						$("#tt650l").show();
						$("#tt650d").show();
					}
					if (data.TT.P663flag=="off"){
						$("#tt663l").hide();
						$("#tt663d").hide();
					}else{
						$("#tt663l").show();
						$("#tt663d").show();
					}
					if (data.TT.COMPLETEDTOTO==0){
						$("#ttlive").show();
					}else{
						$("#ttlive").hide();
					}	


				}catch (err){
					
				}
				try{
					$("#sgtdd").html("Date: "+data.SGPTT.DD);
					$("#sgtdn").html("Draw No: "+data.SGPTT.DN);
					$("#sgtp1").html(data.SGPTT.P1);
					$("#sgtp2").html(data.SGPTT.P2);
					$("#sgtp3").html(data.SGPTT.P3);
					$("#sgtp4").html(data.SGPTT.P4);
					$("#sgtp5").html(data.SGPTT.P5);
					$("#sgtp6").html(data.SGPTT.P6);
					$("#sgtp7").html(data.SGPTT.P7);
					$("#sgtjp1").html(data.SGPTT.JP1);
					$("#sgtjpw1").html(data.SGPTT.JPW1);
					$("#sgtjp2").html(data.SGPTT.JP2);
					$("#sgtjpw2").html(data.SGPTT.JPW2);
					$("#sgtjp3").html(data.SGPTT.JP3);
					$("#sgtjpw3").html(data.SGPTT.JPW3);
					$("#sgtjp4").html(data.SGPTT.JP4);
					$("#sgtjpw4").html(data.SGPTT.JPW4);
					$("#sgtjp5").html(data.SGPTT.JP5);
					$("#sgtjpw5").html(data.SGPTT.JPW5);
					$("#sgtjp6").html(data.SGPTT.JP6);
					$("#sgtjpw6").html(data.SGPTT.JPW6);
					if (data.SGPTT.COMPLETED4D==0){
						$("#sgpttlive").show();
					}else{
						$("#sgpttlive").hide();
					}

				}catch (err){
					
				}
				try{
					$("#mjgdd").html("Date: "+data.M4DJG.DD);
					$("#mjgdn").html("Draw No: "+data.M4DJG.DN);
					$(".mjg1").html(data.M4DJG.P1);
					$(".mjg2").html(data.M4DJG.P2);
					$(".mjg3").html(data.M4DJG.P3);
					$(".mjg4").html(data.M4DJG.P4);
					$(".mjg5").html(data.M4DJG.P5);
					$(".mjg6").html(data.M4DJG.P6);
					$(".mjg7").html(data.M4DJG.P7);
					$(".mjg8").html(data.M4DJG.P8);
					$("#mjgjp1").html(data.M4DJG.JP1);				
					$("#mjgjp2").html(data.M4DJG.JP2);
					if (data.M4DJG.JP1WON>=1){
						$("#mjgjp1won").html("Won");
					}else if(data.M4DJG.JP1WON>0){
						$("#mjgjp1won").html("Partially Won");
					}else{
						$("#mjgjp1won").html("");
					}
					if (data.M4DJG.JP2WON>=1){
						$("#mjgjp2won").html("Won");
					}else if(data.M4DJG.JP2WON>0){
						$("#mjgjp2won").html("Partially Won");
					}else{
						$("#mjgjp2won").html("");
					}
					if (data.M4DJG.COMPLETED4D==0){
						$("#mjglive").show();
					}else{
						$("#mjglive").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#gdd").html("Date: "+data.GD.DD);
					$("#gp1").html(data.GD.P1);
					$("#gp2").html(data.GD.P2);
					$("#gp3").html(data.GD.P3);
					$("#gs1").html(data.GD.S1);
					$("#gs2").html(data.GD.S2);
					$("#gs3").html(data.GD.S3);
					$("#gs4").html(data.GD.S4);
					$("#gs5").html(data.GD.S5);
					$("#gs6").html(data.GD.S6);
					$("#gs7").html(data.GD.S7);
					$("#gs8").html(data.GD.S8);
					$("#gs9").html(data.GD.S9);
					$("#gs10").html(data.GD.S10);
					$("#gs11").html(data.GD.S11);
					$("#gs12").html(data.GD.S12);
					$("#gs13").html(data.GD.S13);
					$("#gc1").html(data.GD.C1);
					$("#gc2").html(data.GD.C2);
					$("#gc3").html(data.GD.C3);
					$("#gc4").html(data.GD.C4);
					$("#gc5").html(data.GD.C5);
					$("#gc6").html(data.GD.C6);
					$("#gc7").html(data.GD.C7);
					$("#gc8").html(data.GD.C8);
					$("#gc9").html(data.GD.C9);
					$("#gc10").html(data.GD.C10);
					if (data.GD.COMPLETED4D==0){
						$("#gdlive").show();
					}else{
						$("#gdlive").hide();
					}					
					
				}catch (err){
					
				}
				try{
					$("#gdd2").html("Date: "+data.GD.DD);
					$("#gd6d1").html(data.GD.GD6D1);
					$("#gd6da1").html(data.GD.GD6DA1);
					$("#gd6da2").html(data.GD.GD6DA2);
					$("#gd6db1").html(data.GD.GD6DB1);
					$("#gd6db2").html(data.GD.GD6DB2);
					$("#gd6dc1").html(data.GD.GD6DC1);
					$("#gd6dc2").html(data.GD.GD6DC2);
					$("#gd6dd1").html(data.GD.GD6DD1);
					$("#gd6dd2").html(data.GD.GD6DD2);
					if (data.GD.COMPLETED6D==0){
						$("#glive2").show();
					}else{
						$("#glive2").hide();
					}					
					
				}catch (err){
					
				}				
				try{
					$("#hdd").html("Date: "+data.H4D6D1.DD);
					$("#hdn").html("Draw No: "+data.H4D6D1.DN);
					$("#hdd6d").html("Date: "+data.H4D6D1.DD);
					$("#hdn6d").html("Draw No: "+data.H4D6D1.DN);
					$("#hp1").html(data.H4D6D1.P1);
					$("#hp2").html(data.H4D6D1.P2);
					$("#hp3").html(data.H4D6D1.P3);
					$("#hs1").html(data.H4D6D1.S1);
					$("#hs2").html(data.H4D6D1.S2);
					$("#hs3").html(data.H4D6D1.S3);
					$("#hs4").html(data.H4D6D1.S4);
					$("#hs5").html(data.H4D6D1.S5);
					$("#hs6").html(data.H4D6D1.S6);
					$("#hs7").html(data.H4D6D1.S7);
					$("#hs8").html(data.H4D6D1.S8);
					$("#hs9").html(data.H4D6D1.S9);
					$("#hs10").html(data.H4D6D1.S10);
					$("#hs11").html(data.H4D6D1.S11);
					$("#hs12").html(data.H4D6D1.S12);
					$("#hs13").html(data.H4D6D1.S13);
					$("#hc1").html(data.H4D6D1.C1);
					$("#hc2").html(data.H4D6D1.C2);
					$("#hc3").html(data.H4D6D1.C3);
					$("#hc4").html(data.H4D6D1.C4);
					$("#hc5").html(data.H4D6D1.C5);
					$("#hc6").html(data.H4D6D1.C6);
					$("#hc7").html(data.H4D6D1.C7);
					$("#hc8").html(data.H4D6D1.C8);
					$("#hc9").html(data.H4D6D1.C9);
					$("#hc10").html(data.H4D6D1.C10);
					// 6D Update
					$("#h6d1").html(data.H4D6D1.prize6D);
					$("#h6d2a1").html(data.H4D6D1.prize6D_2A);
					$("#h6d2b1").html(data.H4D6D1.prize6D_2B);
					$("#h6d3a1").html(data.H4D6D1.prize6D_3A);
					$("#h6d3b1").html(data.H4D6D1.prize6D_3B);
					$("#h6d4a1").html(data.H4D6D1.prize6D_4A);
					$("#h6d4b1").html(data.H4D6D1.prize6D_4B);
					$("#h6d5a1").html(data.H4D6D1.prize6D_5A);
					$("#h6d5b1").html(data.H4D6D1.prize6D_5B);
					if (data.H4D6D1.COMPLETE4D==0){
						$("#hlive").show();
					}else{
						$("#hlive").hide();
					}					
					if (data.H4D6D1.COMPLETE6D==0){
						$("#h6dlive").show();
					}else{
						$("#h6dlive").hide();
					}
				}catch (err){
					
				}
				try{
					$("#hdd2").html("Date: "+data.H4D6D2.DD);
					$("#hdn2").html("Draw No: "+data.H4D6D2.DN);
					$("#hdd26d").html("Date: "+data.H4D6D2.DD);
					$("#hdn26d").html("Draw No: "+data.H4D6D2.DN);
					$("#hp12").html(data.H4D6D2.P1);
					$("#hp22").html(data.H4D6D2.P2);
					$("#hp32").html(data.H4D6D2.P3);
					$("#hs1_2").html(data.H4D6D2.S1);
					$("#hs2_2").html(data.H4D6D2.S2);
					$("#hs3_2").html(data.H4D6D2.S3);
					$("#hs4_2").html(data.H4D6D2.S4);
					$("#hs5_2").html(data.H4D6D2.S5);
					$("#hs6_2").html(data.H4D6D2.S6);
					$("#hs7_2").html(data.H4D6D2.S7);
					$("#hs8_2").html(data.H4D6D2.S8);
					$("#hs9_2").html(data.H4D6D2.S9);
					$("#hs10_2").html(data.H4D6D2.S10);
					$("#hs11_2").html(data.H4D6D2.S11);
					$("#hs12_2").html(data.H4D6D2.S12);
					$("#hs13_2").html(data.H4D6D2.S13);
					$("#hc1_2").html(data.H4D6D2.C1);
					$("#hc2_2").html(data.H4D6D2.C2);
					$("#hc3_2").html(data.H4D6D2.C3);
					$("#hc4_2").html(data.H4D6D2.C4);
					$("#hc5_2").html(data.H4D6D2.C5);
					$("#hc6_2").html(data.H4D6D2.C6);
					$("#hc7_2").html(data.H4D6D2.C7);
					$("#hc8_2").html(data.H4D6D2.C8);
					$("#hc9_2").html(data.H4D6D2.C9);
					$("#hc10_2").html(data.H4D6D2.C10);
					// 6D Update
					$("#h6d2").html(data.H4D6D2.prize6D);
					$("#h6d2a2").html(data.H4D6D2.prize6D_2A);
					$("#h6d2b2").html(data.H4D6D2.prize6D_2B);
					$("#h6d3a2").html(data.H4D6D2.prize6D_3A);
					$("#h6d3b2").html(data.H4D6D2.prize6D_3B);
					$("#h6d4a2").html(data.H4D6D2.prize6D_4A);
					$("#h6d4b2").html(data.H4D6D2.prize6D_4B);
					$("#h6d5a2").html(data.H4D6D2.prize6D_5A);
					$("#h6d5b2").html(data.H4D6D2.prize6D_5B);
					if (data.H4D6D2.COMPLETE4D==0){
						$("#hlive2").show();
					}else{
						$("#hlive2").hide();
					}					
					if (data.H4D6D2.COMPLETE6D==0){
						$("#h6dlive2").show();
					}else{
						$("#h6dlive2").hide();
					}
				}catch (err){
					
				}
				try{
					$("#pdd").html("Date: "+data.P4D1.DD);
					$("#pp1").html(data.P4D1.P1);
					$("#pp2").html(data.P4D1.P2);
					$("#pp3").html(data.P4D1.P3);
					$("#ps1").html(data.P4D1.S1);
					$("#ps2").html(data.P4D1.S2);
					$("#ps3").html(data.P4D1.S3);
					$("#ps4").html(data.P4D1.S4);
					$("#ps5").html(data.P4D1.S5);
					$("#ps6").html(data.P4D1.S6);
					$("#ps7").html(data.P4D1.S7);
					$("#ps8").html(data.P4D1.S8);
					$("#ps9").html(data.P4D1.S9);
					$("#ps10").html(data.P4D1.S10);
					$("#ps11").html(data.P4D1.S11);
					$("#ps12").html(data.P4D1.S12);
					$("#ps13").html(data.P4D1.S13);
					$("#pc1").html(data.P4D1.C1);
					$("#pc2").html(data.P4D1.C2);
					$("#pc3").html(data.P4D1.C3);
					$("#pc4").html(data.P4D1.C4);
					$("#pc5").html(data.P4D1.C5);
					$("#pc6").html(data.P4D1.C6);
					$("#pc7").html(data.P4D1.C7);
					$("#pc8").html(data.P4D1.C8);
					$("#pc9").html(data.P4D1.C9);
					$("#pc10").html(data.P4D1.C10);
					if (data.P4D1.COMPLETE4D==0){
						$("#plive").show();
					}else{
						$("#plive").hide();
					}					

				}catch (err){
					
				}
				try{
					$("#pdd_2").html("Date: "+data.P4D2.DD);
					$("#pp1_2").html(data.P4D2.P1);
					$("#pp2_2").html(data.P4D2.P2);
					$("#pp3_2").html(data.P4D2.P3);
					$("#ps1_2").html(data.P4D2.S1);
					$("#ps2_2").html(data.P4D2.S2);
					$("#ps3_2").html(data.P4D2.S3);
					$("#ps4_2").html(data.P4D2.S4);
					$("#ps5_2").html(data.P4D2.S5);
					$("#ps6_2").html(data.P4D2.S6);
					$("#ps7_2").html(data.P4D2.S7);
					$("#ps8_2").html(data.P4D2.S8);
					$("#ps9_2").html(data.P4D2.S9);
					$("#ps10_2").html(data.P4D2.S10);
					$("#ps11_2").html(data.P4D2.S11);
					$("#ps12_2").html(data.P4D2.S12);
					$("#ps13_2").html(data.P4D2.S13);
					$("#pc1_2").html(data.P4D2.C1);
					$("#pc2_2").html(data.P4D2.C2);
					$("#pc3_2").html(data.P4D2.C3);
					$("#pc4_2").html(data.P4D2.C4);
					$("#pc5_2").html(data.P4D2.C5);
					$("#pc6_2").html(data.P4D2.C6);
					$("#pc7_2").html(data.P4D2.C7);
					$("#pc8_2").html(data.P4D2.C8);
					$("#pc9_2").html(data.P4D2.C9);
					$("#pc10_2").html(data.P4D2.C10);
					if (data.P4D2.COMPLETE4D==0){
						$("#plive2").show();
					}else{
						$("#plive2").hide();
					}					

				}catch (err){
					
				}	
				try{
					$("#lmcdd").html("Date: "+data.LMC.DD);
					$("#lmcdn").html(data.LMC.DN);
					$("#lmcp1").html(data.LMC.P1);
					$("#lmcp2").html(data.LMC.P2);
					$("#lmcp3").html(data.LMC.P3);
					$("#lmcs1").html(data.LMC.S1);
					$("#lmcs2").html(data.LMC.S2);
					$("#lmcs3").html(data.LMC.S3);
					$("#lmcs4").html(data.LMC.S4);
					$("#lmcs5").html(data.LMC.S5);
					$("#lmcs6").html(data.LMC.S6);
					$("#lmcs7").html(data.LMC.S7);
					$("#lmcs8").html(data.LMC.S8);
					$("#lmcs9").html(data.LMC.S9);
					$("#lmcs10").html(data.LMC.S10);
					$("#lmcs11").html(data.LMC.S11);
					$("#lmcs12").html(data.LMC.S12);
					$("#lmcs13").html(data.LMC.S13);
					$("#lmcc1").html(data.LMC.C1);
					$("#lmcc2").html(data.LMC.C2);
					$("#lmcc3").html(data.LMC.C3);
					$("#lmcc4").html(data.LMC.C4);
					$("#lmcc5").html(data.LMC.C5);
					$("#lmcc6").html(data.LMC.C6);
					$("#lmcc7").html(data.LMC.C7);
					$("#lmcc8").html(data.LMC.C8);
					$("#lmcc9").html(data.LMC.C9);
					$("#lmcc10").html(data.LMC.C10);
					if (data.LMC.COMPLETED4D==0){
						$("#lmclive").show();
					}else{
						$("#lmclive").hide();
					}					
					
				}catch (err){
					
				}	
				try{
					$("#lmcdd_1").html("Date: "+data.LMC1.DD);
					$("#lmcdn_1").html(data.LMC1.DN);
					$("#lmcp1_1").html(data.LMC1.P1);
					$("#lmcp2_1").html(data.LMC1.P2);
					$("#lmcp3_1").html(data.LMC1.P3);
					$("#lmcs1_1").html(data.LMC1.S1);
					$("#lmcs2_1").html(data.LMC1.S2);
					$("#lmcs3_1").html(data.LMC1.S3);
					$("#lmcs4_1").html(data.LMC1.S4);
					$("#lmcs5_1").html(data.LMC1.S5);
					$("#lmcs6_1").html(data.LMC1.S6);
					$("#lmcs7_1").html(data.LMC1.S7);
					$("#lmcs8_1").html(data.LMC1.S8);
					$("#lmcs9_1").html(data.LMC1.S9);
					$("#lmcs10_1").html(data.LMC1.S10);
					$("#lmcs11_1").html(data.LMC1.S11);
					$("#lmcs12_1").html(data.LMC1.S12);
					$("#lmcs13_1").html(data.LMC1.S13);
					$("#lmcc1_1").html(data.LMC1.C1);
					$("#lmcc2_1").html(data.LMC1.C2);
					$("#lmcc3_1").html(data.LMC1.C3);
					$("#lmcc4_1").html(data.LMC1.C4);
					$("#lmcc5_1").html(data.LMC1.C5);
					$("#lmcc6_1").html(data.LMC1.C6);
					$("#lmcc7_1").html(data.LMC1.C7);
					$("#lmcc8_1").html(data.LMC1.C8);
					$("#lmcc9_1").html(data.LMC1.C9);
					$("#lmcc10_1").html(data.LMC1.C10);
					if (data.LMC1.COMPLETED4D==0){
						$("#lmclive1").show();
					}else{
						$("#lmclive1").hide();
					}					
					
				}catch (err){
					
				}	
				try{
					$("#mthdd").html("Date: "+data.MTH.DD);
					$("#mthdn").html(data.MTH.DN);
					$("#mthp1").html(data.MTH.P1);
					$("#mthp2").html(data.MTH.P2);
					$("#mthp3").html(data.MTH.P3);
					$("#mths1").html(data.MTH.S1);
					$("#mths2").html(data.MTH.S2);
					$("#mths3").html(data.MTH.S3);
					$("#mths4").html(data.MTH.S4);
					$("#mths5").html(data.MTH.S5);
					$("#mths6").html(data.MTH.S6);
					$("#mths7").html(data.MTH.S7);
					$("#mths8").html(data.MTH.S8);
					$("#mths9").html(data.MTH.S9);
					$("#mths10").html(data.MTH.S10);
					$("#mths11").html(data.MTH.S11);
					$("#mths12").html(data.MTH.S12);
					$("#mths13").html(data.MTH.S13);
					$("#mthc1").html(data.MTH.C1);
					$("#mthc2").html(data.MTH.C2);
					$("#mthc3").html(data.MTH.C3);
					$("#mthc4").html(data.MTH.C4);
					$("#mthc5").html(data.MTH.C5);
					$("#mthc6").html(data.MTH.C6);
					$("#mthc7").html(data.MTH.C7);
					$("#mthc8").html(data.MTH.C8);
					$("#mthc9").html(data.MTH.C9);
					$("#mthc10").html(data.MTH.C10);
					if (data.MTH.COMPLETED4D==0){
						$("#mthlive").show();
					}else{
						$("#mthlive").hide();
					}					
					
				}catch (err){
					
				}	
				try{
					$("#nltdd").html("Date: "+data.NLT.DD);
					$("#nltdn").html(data.NLT.DN);
					$("#nltp1").html(data.NLT.P1);
					$("#nltp2").html(data.NLT.P2);
					$("#nltp3").html(data.NLT.P3);
					$("#nlts1").html(data.NLT.S1);
					$("#nlts2").html(data.NLT.S2);
					$("#nlts3").html(data.NLT.S3);
					$("#nlts4").html(data.NLT.S4);
					$("#nlts5").html(data.NLT.S5);
					$("#nlts6").html(data.NLT.S6);
					$("#nlts7").html(data.NLT.S7);
					$("#nlts8").html(data.NLT.S8);
					$("#nlts9").html(data.NLT.S9);
					$("#nlts10").html(data.NLT.S10);
					$("#nlts11").html(data.NLT.S11);
					$("#nlts12").html(data.NLT.S12);
					$("#nlts13").html(data.NLT.S13);
					$("#nltc1").html(data.NLT.C1);
					$("#nltc2").html(data.NLT.C2);
					$("#nltc3").html(data.NLT.C3);
					$("#nltc4").html(data.NLT.C4);
					$("#nltc5").html(data.NLT.C5);
					$("#nltc6").html(data.NLT.C6);
					$("#nltc7").html(data.NLT.C7);
					$("#nltc8").html(data.NLT.C8);
					$("#nltc9").html(data.NLT.C9);
					$("#nltc10").html(data.NLT.C10);
					// 6D Update
					$("#nltdd2").html("Date: "+data.NLT.DD);
					$("#nltdn2").html(data.NLT.DN);

					$("#nltd6d1").html(data.NLT.P6D1);
					$("#nltd6d2a").html(data.NLT.P6D2A);
					$("#nltd6d2b").html(data.NLT.P6D2B);
					$("#nltd6d3a").html(data.NLT.P6D3A);
					$("#nltd6d3b").html(data.NLT.P6D3B);
					$("#nltd6d4a").html(data.NLT.P6D4A);
					$("#nltd6d4b").html(data.NLT.P6D4B);
					$("#nltd6d5a").html(data.NLT.P6D5A);
					$("#nltd6d5b").html(data.NLT.P6D5B);
					if (data.NLT.COMPLETED4D==0){
						$("#nltlive").show();
					}else{
						$("#nltlive").hide();
					}					
					if (data.NLT.COMPLETED6D==0){
						$("#nltlive2").show();
					}else{
						$("#nltlive2").hide();
					}						
				}catch (err){
					
				}			
		  }
	});
}
function hideloader(){
	$("#loadmsg").hide()
}

function setCookie(name,value,hours) {
    var expires = "";
    if (hours) {
        var date = new Date();
      date.setTime(date.getTime() + (hours*60*60*1000));
      //date.setTime(date.getTime() + (hours*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
UpdateStatus('');