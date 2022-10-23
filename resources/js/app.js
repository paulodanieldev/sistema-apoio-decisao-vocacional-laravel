/**
 * Template Name: NiceAdmin - v2.4.1
 * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

require("./bootstrap");
require("./dashboard/common");
require("./bootstable/bootstable");

import Quill from "quill";
import ApexCharts from "apexcharts";
import { DataTable } from "simple-datatables";
import tinymce from "tinymce/tinymce";
import "tinymce/plugins/link";
import "jquery-confirm/js/jquery-confirm";

import * as echarts from "echarts";

(function () {
    ("use strict");

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach((e) => e.addEventListener(type, listener));
        } else {
            select(el, all).addEventListener(type, listener);
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Sidebar toggle
     */
    if (select(".toggle-sidebar-btn")) {
        on("click", ".toggle-sidebar-btn", function (e) {
            select("body").classList.toggle("toggle-sidebar");
        });
    }

    /**
     * Search bar toggle
     */
    if (select(".search-bar-toggle")) {
        on("click", ".search-bar-toggle", function (e) {
            select(".search-bar").classList.toggle("search-bar-show");
        });
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add("header-scrolled");
            } else {
                selectHeader.classList.remove("header-scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /**
     * Initiate quill editors
     */
    if (select(".quill-editor-default")) {
        new Quill(".quill-editor-default", {
            theme: "snow",
        });
    }

    if (select(".quill-editor-bubble")) {
        new Quill(".quill-editor-bubble", {
            theme: "bubble",
        });
    }

    if (select(".quill-editor-full")) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [
                        {
                            font: [],
                        },
                        {
                            size: [],
                        },
                    ],
                    ["bold", "italic", "underline", "strike"],
                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ],
                    [
                        {
                            script: "super",
                        },
                        {
                            script: "sub",
                        },
                    ],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ],
                    [
                        "direction",
                        {
                            align: [],
                        },
                    ],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            theme: "snow",
        });
    }

    /**
     * Initiate TinyMCE Editor
     */
    const useDarkMode = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const isSmallScreen = window.matchMedia("(max-width: 1023.5px)").matches;

    tinymce.init({
        selector: "textarea.tinymce-editor",
        plugins:
            "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",
        editimage_cors_hosts: ["picsum.photos"],
        menubar: "file edit view insert format tools table help",
        toolbar:
            "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",
        toolbar_sticky: true,
        toolbar_sticky_offset: isSmallScreen ? 102 : 108,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        link_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_list: [
            {
                title: "My page 1",
                value: "https://www.tiny.cloud",
            },
            {
                title: "My page 2",
                value: "http://www.moxiecode.com",
            },
        ],
        image_class_list: [
            {
                title: "None",
                value: "",
            },
            {
                title: "Some class",
                value: "class-name",
            },
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === "file") {
                callback("https://www.google.com/logos/google.jpg", {
                    text: "My text",
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === "image") {
                callback("https://www.google.com/logos/google.jpg", {
                    alt: "My alt text",
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === "media") {
                callback("movie.mp4", {
                    source2: "alt.ogg",
                    poster: "https://www.google.com/logos/google.jpg",
                });
            }
        },
        templates: [
            {
                title: "New Table",
                description: "creates a new table",
                content:
                    '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>',
            },
            {
                title: "Starting my story",
                description: "A cure for writers block",
                content: "Once upon a time...",
            },
            {
                title: "New list with dates",
                description: "New List with dates",
                content:
                    '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>',
            },
        ],
        template_cdate_format: "[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]",
        template_mdate_format: "[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]",
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar:
            "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
        noneditable_class: "mceNonEditable",
        toolbar_mode: "sliding",
        contextmenu: "link image table",
        skin: useDarkMode ? "oxide-dark" : "oxide",
        content_css: useDarkMode ? "dark" : "default",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(needsValidation).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    /**
     * Initiate Datatables
     */
    const datatables = select(".datatable", true);
    datatables.forEach((datatable) => {
        new DataTable(datatable);
    });

    /**
     * Autoresize echart charts
     */
    const mainContainer = select("#main");
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select(".echart", true).forEach((getEchart) => {
                    echarts.getInstanceByDom(getEchart).resize();
                });
            }).observe(mainContainer);
        }, 200);
    }

    /**
     * Autoresize echart charts
     */
    const reportsChart = select("#reportsChart");
    if (reportsChart) {
        new ApexCharts(reportsChart, {
            series: [
                {
                    name: "Sales",
                    data: [31, 40, 28, 51, 42, 82, 56],
                },
                {
                    name: "Revenue",
                    data: [11, 32, 45, 32, 34, 52, 41],
                },
                {
                    name: "Customers",
                    data: [15, 11, 32, 18, 9, 24, 11],
                },
            ],
            chart: {
                height: 350,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            markers: {
                size: 4,
            },
            colors: ["#4154f1", "#2eca6a", "#ff771d"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                width: 2,
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2018-09-19T00:00:00.000Z",
                    "2018-09-19T01:30:00.000Z",
                    "2018-09-19T02:30:00.000Z",
                    "2018-09-19T03:30:00.000Z",
                    "2018-09-19T04:30:00.000Z",
                    "2018-09-19T05:30:00.000Z",
                    "2018-09-19T06:30:00.000Z",
                ],
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
        }).render();
    }

    const budgetChartEl = select("#budgetChart");
    if (budgetChartEl) {
        var budgetChart = echarts.init(budgetChartEl);
        budgetChart.setOption({
            legend: {
                data: ["Allocated Budget", "Actual Spending"],
            },
            radar: {
                // shape: 'circle',
                indicator: [
                    {
                        name: "Sales",
                        max: 6500,
                    },
                    {
                        name: "Administration",
                        max: 16000,
                    },
                    {
                        name: "Information Technology",
                        max: 30000,
                    },
                    {
                        name: "Customer Support",
                        max: 38000,
                    },
                    {
                        name: "Development",
                        max: 52000,
                    },
                    {
                        name: "Marketing",
                        max: 25000,
                    },
                ],
            },
            series: [
                {
                    name: "Budget vs spending",
                    type: "radar",
                    data: [
                        {
                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                            name: "Allocated Budget",
                        },
                        {
                            value: [5000, 14000, 28000, 26000, 42000, 21000],
                            name: "Actual Spending",
                        },
                    ],
                },
            ],
        });
    }

    const trafficChartEl = select("#trafficChart");
    if (trafficChartEl) {
        var trafficChart = echarts.init(trafficChartEl);
        trafficChart.setOption({
            tooltip: {
                trigger: "item",
            },
            legend: {
                top: "5%",
                left: "center",
            },
            series: [
                {
                    name: "Access From",
                    type: "pie",
                    radius: ["40%", "70%"],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: "center",
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: "18",
                            fontWeight: "bold",
                        },
                    },
                    labelLine: {
                        show: false,
                    },
                    data: [
                        {
                            value: 1048,
                            name: "Search Engine",
                        },
                        {
                            value: 735,
                            name: "Direct",
                        },
                        {
                            value: 580,
                            name: "Email",
                        },
                        {
                            value: 484,
                            name: "Union Ads",
                        },
                        {
                            value: 300,
                            name: "Video Ads",
                        },
                    ],
                },
            ],
        });
    }
})();
