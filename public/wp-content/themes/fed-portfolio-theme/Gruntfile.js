/* Generell Grunt: */
module.exports = function(grunt) {

	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

/* SASS */
		sass: {
			dist: {
				options: {
					style: 'compressed',//compressed = minifierad
					sourcemap: 'none',
					precision: 2,
					update: true
				},
				files: {
					'css/style.css' : 'src/scss/style.scss' //Målfil : källfil
				}
			}
		},

/* Post CSS (Auto prefixar för två senaste versioner av browsers)*/
		postcss: {
			options: {
				map: false,
				processors: [
					require('autoprefixer')({browsers: 'last 2 versions'}),
					require('cssnano')()
				]
			},
			dist: {
				src: 'css/*.css'
			}
		},
/* UGLIFY */
		uglify: {

			options: {
				beautify: false,
				preserveComments: false,
				//quoteStyle: 1, //Gör om dubbla qoutes till enkla, 3 gör ingen ändring alls.
				compress: {
					drop_console: false //Kan ta bort alla console.log utskrifter om satt till true
				}
			},
			build: {
				files: [{
					expand: true,
					src: 'src/js/build/*.js',
					dest: 'js/',
					flatten: true,
					rename: function(destBase, destPath) {
						return destBase + destPath.replace('.js', '.min.js');
					}
				}]
			}
		},

/* CONCAT (slår ihop, konkatinerar alla våra javascript filer till en) */

		concat: {

			options: {
				separator: '\n'
			},
			dist: {
				src: ['src/js/*.js'], //Dessa filer ska slås ihop. Går att ta alla i mappen med src/js/*.js
				dest: 'src/js/build/scripts.js'
			}
		},

/* Watch (autouppdaterar vid förändringar, en slipper köra grunt kommandot hela tiden) */
		watch: {
			css: {
				files: ['**/*.scss'], //plockar allt den kan hitta med rätt filändelse
				tasks: ['sass', 'postcss'] //Sätter ordningen
			},
			js: {
				files: ['src/js/*.js'],
				tasks: ['concat', 'uglify']
				},
			options: {
				nospawn: true
			}
		}

		});

	//grunt.registerTask('default', ['sass', 'postcss']); //'sass' här hänger ihop med rad 10
	grunt.registerTask('default', ['watch']); //klumpar ihop ovan

}

