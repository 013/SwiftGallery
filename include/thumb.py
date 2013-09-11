#!/usr/bin/python
import os, sys
import Image

size = 250, 250

def thumb(infile, ext):
	outfile = os.path.splitext(infile)[0] + "_thumb" + ext
	types = {'.jpg' : 'JPEG', '.jpeg' : 'JPEG', '.png' : 'PNG', '.gif' : 'GIF'}
	try:
		im = Image.open(infile)
		im = im.convert('RGB')
		im.thumbnail(size, Image.ANTIALIAS)
		im.save(outfile, types[ext.lower()])
	except IOError, e:
		# Needs changing to write errors to a file
		print "cannot create thumbnail for", infile
		print outfile
		print e

thumb(sys.argv[1], sys.argv[2])

