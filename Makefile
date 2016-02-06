
OBJTREE		:= $(CURDIR)
SRCTREE		:= $(CURDIR)
TOPDIR		:= $(SRCTREE)
LNDIR		:= $(OBJTREE)
export	TOPDIR SRCTREE OBJTREE

git:
	chown gyc:gyc www -R
	git add --all .
	git commit
	chown www-data:www-data www -R

clean:
	@find $(OBJTREE) -type f \
		\( -name 'core' -o -name '*.bak' -o -name '*~' -o -name '*.map' \
		-o -name '*.o'	-o -name '*.a' -o -name '*.exe' -o -name '*.s'	\) -print \
		| xargs rm -f

