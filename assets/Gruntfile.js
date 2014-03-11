module.exports = function (grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		options: grunt.file.readJSON('config.json'),

		clean: {
			css: {
				src: '<%= options.css.dist %>'
			},
			svg: {
				src: ['<%= options.svg.dist %>', '<%= options.css.src %>/*-sprites.css']
			},
			tmp: {
				src: '<%= options.tmp %>'
			}
		},

		uglify: {
			options: {
				banner: '/*!    */'
			},
			dist: {
				src: ['<%= options.js.files %>'],
				dest: '<%= options.js.dist %>/main.js'
			},
		},

		less: {
			main: {
				options: {
					yuicompress: true,
					ieCompat: true
				},
				files: {
					'<%= options.less.dist %>': '<%= options.less.file %>'
				}
			}
		},

		cssmin: {
			minify: {
				files: {
					'<%= options.css.min %>': '<%= options.css.files %>'
				}
			}
		},

		'svg-sprites': {
			options: {
				spriteElementPath: '<%= options.svg.src %>',
				spritePath: '<%= options.svg.dist %>',
				cssPath: '<%= options.svg.css %>'
			},

			/*
			icons: {
				options: {
					sizes: {
						large: 30,
						medium: 25,
						small: 20
					},
					refSize: 30
				}
			}
			*/

		},

		legacssy: {
			options: {
				legacyWidth: 1025
			},
			ie8: {
				files: {
					'<%= options.css.legacssy %>': ['<%= options.css.min %>'],
				}
			}
		},

		watch: {
			svg: {
				files: ['<%= options.svg.files %>'],
				tasks: ['svg']
			},
			less: {
				files: ['<%= options.less.file %>'],
				tasks: ['less']
			},
			css: {
				files: ['<%= options.css.files %>'],
				tasks: ['css']
			},
			js: {
				files: ['<%= options.js.files %>'],
				tasks: ['uglify']
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-legacssy');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('dr-grunt-svg-sprites');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', 'watch');
	grunt.registerTask('svg', ['clean:svg', 'svg-sprites']);
	grunt.registerTask('css', ['clean:css', 'cssmin', 'legacssy', 'clean:tmp']);
}
