
const icons = document.getElementsByTagName('img'); 
let i = 0
setInterval(() => {
	i++
	const icon = document.querySelector('.landing-page-icons .change')
	icon.classList.remove('change')

	if (i > icons.length) {
		icons[0].classList.add('change')
		i = 0
	} else {
		icon.nextElementSibling.classList.add('change')
	}
}, 4500)
