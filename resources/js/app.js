import "./bootstrap";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

gsap.registerPlugin(ScrollTrigger);

// gsap.to(".mover", {
//     ScrollTrigger: {
//         trigger: ".mover",
//         start: "top center",
//         end: "top 100px",
//         scrub: 1,
//         markers: true,
//     },
//     x: 400,
//     rotation: 360,
//     ease: "none",
//     duration: 3,
// });

document.addEventListener("DOMContentLoaded", () => {
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    const tl = gsap.timeline(); //

    tl.from(".hero-tagline", {
        y: -20,
        opacity: 0,
        duration: 0.6,
    })
        .from(
            ".hero-title-1",
            {
                y: 40,
                opacity: 0,
                duration: 0.8,
            },
            "-=0.3",
        )
        .from(
            ".hero-title-2",
            {
                y: 40,
                opacity: 0,
                duration: 0.8,
            },
            "-=0.6",
        )
        .from(
            ".hero-desc",
            {
                opacity: 0,
                duration: 0.6,
            },
            "-=0.4",
        )
        .from(
            ".hero-btn",
            {
                scale: 0.9,
                opacity: 0,
                rotationX: 360,
                duration: 1.2,
            },
            "-=0.3",
        );

    if (prefersReducedMotion) {
        return;
    }

    gsap.from(".home-preview", {
        scrollTrigger: {
            trigger: ".home-preview",
            start: "top 80%",
            once: true,
        },
        y: 28,
        opacity: 0,
        duration: 0.9,
        ease: "power2.out",
    });

    gsap.from(".plan-card", {
        scrollTrigger: {
            trigger: "#planes",
            start: "top 75%",
            once: true,
        },
        y: 30,
        opacity: 0,
        duration: 0.7,
        stagger: 0.14,
        ease: "power2.out",
    });

    gsap.to(".plan-card--featured", {
        scrollTrigger: {
            trigger: "#planes",
            start: "top 75%",
            once: true,
        },
        boxShadow: "0 0 55px rgba(139, 92, 246, 0.3)",
        repeat: -1,
        yoyo: true,
        duration: 2.6,
        ease: "sine.inOut",
    });

    gsap.from(".class-card", {
        scrollTrigger: {
            trigger: "#clases",
            start: "top 75%",
            once: true,
        },
        y: 26,
        opacity: 0,
        duration: 0.7,
        stagger: 0.12,
        ease: "power2.out",
    });

    gsap.from(".logros", {
        scrollTrigger: {
            trigger: ".logros",
            start: "top 75%",
            once: true,
        },
        y: 26,
        opacity: 0,
        duration: 0.7,
        stagger: 0.12,
        ease: "power2.out",
    });

    gsap.from(".btn-exper", {
        scrollTrigger: {
            trigger: ".btn-exper",
            start: "top 75%",
            once: true,
        },
        y: 26,
        opacity: 0,
        stagger: 0.12,
        ease: "power2.out",
        scale: 0.9,
        rotationX: 360,
        duration: 1.2,
    });

    gsap.from(".pagination-wrap", {
        scrollTrigger: {
            trigger: ".pagination-wrap",
            start: "top 90%",
            once: true,
        },
        x: 40,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
    });

    gsap.from(".tip-card", {
        scrollTrigger: {
            trigger: ".tip-card",
            start: "top 85%",
            once: true,
        },
        y: 24,
        opacity: 0,
        duration: 0.65,
        stagger: 0.12,
        ease: "power2.out",
    });

    gsap.from(".testimonial-card", {
        scrollTrigger: {
            trigger: ".testimonial-card",
            start: "top 85%",
            once: true,
        },
        y: 24,
        opacity: 0,
        rotate: (index) => [-1.2, 0, 1.2][index] || 0,
        duration: 0.7,
        stagger: 0.12,
        ease: "power2.out",
    });



    gsap.from(".cta-section", {
        scrollTrigger: {
            trigger: ".cta-section",
            start: "top 85%",
            once: true,
        },
        y: 26,
        opacity: 0,
        duration: 0.8,
        ease: "power2.out",
    });

    gsap.to(".cta-section", {
        boxShadow: "0 0 40px rgba(139, 92, 246, 0.22)",
        repeat: -1,
        yoyo: true,
        duration: 2.8,
        ease: "sine.inOut",
    });
});