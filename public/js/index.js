const links = document.querySelectorAll('.menu_item a');
const introBtn = document.querySelector('.intro-button');

links.forEach(link => link.addEventListener('click', e => {
    e.preventDefault();
    const href = e.target.getAttribute('href').slice(1);

    document.getElementById(href).scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}));

introBtn.addEventListener('click', () => {
    document.getElementById('services').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});

let acc = document.querySelectorAll(".service-top");

for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.children[0].classList.toggle("service-active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
            panel.style.borderBottom = 'none';
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            panel.style.borderBottom = '1px solid var(--color-green)';
        }
    });
}

const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 500,
    autoplay: {
        delay: 10000,
    },
});

gsap.registerPlugin(ScrollTrigger);
/*gsap.timeline()
    .from('.main-menu', {
        y: -120,
        duration: 1
    })
    .from('.main-menu .menu li', {
        y: -120,
        stagger: 0.1
    })
    .from('.intro-left', {
        x: -200,
        opacity: 0,
        duration: 1,
    }, '-=0.5')
    .from('.intro-right', {
        transform: 'scale(0)',
        duration: 1,
        delay: 0.5
    }, '-=0.5');*/
gsap.from('.navigation', {
    y: -120,
    duration: 1.5
})

gsap.from('.intro-left', {
    x: -200,
    opacity: 0,
    duration: 1,
}, '-=0.5')

gsap.from('.intro-right', {
    transform: 'scale(0)',
    duration: 1,
    delay: 0.5
}, '-=0.5')

gsap.from('.about-us__info-img-block', {
    scrollTrigger: {
        trigger: '.about-us__info-img-block',
        start: 'top center',
    },
    x: -120,
    opacity: 0,
    duration: 1
})

gsap.from('.about-us__info-blocks div', {
    scrollTrigger: {
        trigger: '.about-us__info-img-block',
        start: 'top center',
    },
    transform: 'scale(0)',
    duration: 1,
    stagger: 0.3
})

gsap.from('.about-us__description', {
    scrollTrigger: {
        trigger: '.about-us',
        start: 'top center',
    },
    y: -250,
    opacity: 0,
    duration: 1,
})

gsap.from('.about-us__images div', {
    scrollTrigger: {
        trigger: '.about-us',
        start: 'center center',
    },
    transform: 'scale(0)',
    duration: 1,
    stagger: 0.3
})

gsap.from('.service', {
    scrollTrigger: {
        trigger: '.services-section',
        start: 'top center',
    },
    x: -250,
    opacity: 0,
    duration: 0.5,
    stagger: 0.3
})

gsap.from('.swiper', {
    scrollTrigger: {
        trigger: '.feedbacks-section',
        start: 'top center',
    },
    transform: 'scale(0)',
    duration: 0.5,
})

gsap.from('.employee', {
    scrollTrigger: {
        trigger: '.employees-section',
        start: 'top center',
    },
    transform: 'scale(0)',
    duration: 1,
    stagger: 0.3
})

gsap.from('.license div', {
    scrollTrigger: {
        trigger: '.license-section',
        start: 'top center',
    },
    transform: 'scale(0)',
    duration: 1,
    stagger: 0.3
})

const titles = document.querySelectorAll('.title');
titles.forEach(title => {
    gsap.from(title, {
        scrollTrigger: {
            trigger: title,
            start: 'top center',
        },
        y: -100,
        opacity: 0,
        duration: 0.5,
    })
});
