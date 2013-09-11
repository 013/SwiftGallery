#!/usr/bin/python
import os, sys
import Image

size = 250, 250

path = ""

#for infile in sys.argv[1:]:

def thumb(infile, ext):
	outfile = path + os.path.splitext(infile)[0] + "_thumb" + ext
	types = {'.jpg' : 'JPEG', '.jpeg' : 'JPEG', '.png' : 'PNG', '.gif' : 'GIF'}
	if infile != outfile:
		try:
			im = Image.open(infile)
			im = im.convert('RGB')
			im.thumbnail(size, Image.ANTIALIAS)
			im.save(outfile, types[ext.lower()])#"JPEG")
		except IOError, e:
			print "cannot create thumbnail for", infile
			print outfile
			print e


thumb(sys.argv[1], sys.argv[2])
