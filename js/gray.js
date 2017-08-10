function gray()
{
	document.getElementById('grayBG').style.width='100%';
	document.getElementById('grayBG').style.height=document.body.offsetHeight+'px';
	document.getElementById('grayBG').style.background='#000';
	document.getElementById('grayBG').style.opacity='0.3';
	document.getElementById('grayBG').style.filter='alpha(opacity=30)';
	document.getElementById('grayBG').style.display='block';
}
function gray_hide()
{
	document.getElementById('grayBG').style.display='none';
}
function grayMessage()
{
	document.getElementById('grayBGMessage').style.width='100%';
	document.getElementById('grayBGMessage').style.height=document.body.offsetHeight+'px';
	document.getElementById('grayBGMessage').style.display='block';
}
function grayMessage_hide()
{
	document.getElementById('grayBGMessage').style.display='none';
}

