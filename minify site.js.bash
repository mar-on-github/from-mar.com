
npm install terser -g
npm update terser -g

terser assets/scripts/site.js -c > assets/scripts/site.min.js
terser assets/scripts/pageinfo.js -c > assets/scripts/pageinfo.min.js