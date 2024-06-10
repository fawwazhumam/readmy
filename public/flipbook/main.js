"use strict";

/* for development/hotloading */
//import * as flipbook from '../src'

import * as flipbook from "./flipbook-viewer.js";

import * as book from "./book-pdf.js";

/*    understand/
 * main entry point into our program
 */
function main() {
  const opts = {
    width: 800,
    height: 600,
  };

  const app = document.getElementById("app");
  const next = document.getElementById("next");
  const prev = document.getElementById("prev");
  const zoom = document.getElementById("zoom");
  const pdfUrl = app.getAttribute("href");

  book.init(pdfUrl, (err, book) => {
    if (err) console.error(err);
    else
      flipbook.init(book, app, opts, (err, viewer) => {
        if (err) return console.error(err);

        viewer.on("seen", (n) => {});

        next.onclick = () => viewer.flip_forward();
        prev.onclick = () => viewer.flip_back();
        zoom.onclick = () => viewer.zoom();
      });
  });
}

main();
