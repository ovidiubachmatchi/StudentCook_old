
const icons = document.getElementsByTagName('img'); 
let i = 0
setInterval(() => {
	i++
	icons[i-1].classList.remove('change')
	if (i <= 13)
		icons[i].classList.add('change')
	else
	{
		icons[1].classList.add("change")
		i=0
	}
}, 3500)
